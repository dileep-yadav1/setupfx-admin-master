<?php

namespace App\Helpers;

use App\Models\AdminSetting;
use App\Models\MailVariable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TemplateParser
{
    /**
     * @var $templateStr
     */
    private $templateStr;

    /**
     * optional in case of raw messages
     *
     * @var mixed|string $rawMessage
     */
    private $rawMessage = "";

    /**
     * @var $templateVariables
     */
    private $templateVariables = [];

    /**
     * The final compiled template
     *
     * @var string $compiled
     */
    private $compiled = "";

    /**
     * container for dynamic data variables
     *
     * @var array $dynamicData
     */
    private $dynamicData = [];

    public function __construct($templateStr, $rawMessage = "")
    {
        $this->templateStr = $templateStr;

        $this->rawMessage = $rawMessage;
    }

    public function process()
    {
        // first: retrieve variable keys using regex using this pattern
        $matches = $this->getMatchedTemplateVariables();
        // second: loop for the matches and retrieve each variable from mail_variables table
        if ($matches && count($matches) > 0) {
            $this->templateVariables = $this->getParsedTemplateVariables($matches);
        }

        $this->compiled = $this->replaceKeysWithValues();
    }

    public function getCompiled()
    {
        return $this->compiled;
    }

    /**
     * setter for dynamic data
     */
    public function __set($propertyName, $propertyValue)
    {
        $this->dynamicData[$propertyName] = $propertyValue;
    }

    /**
     * getter for dynamic data
     */
    public function __get($propertyName)
    {
        if (array_key_exists($propertyName, $this->dynamicData)) {
            return $this->dynamicData[$propertyName];
        }

        return "";
    }

    private function getMatchedTemplateVariables()
    {
        $regex = '/\[\w.+?\]/m';

        preg_match_all($regex, $this->templateStr, $matches, PREG_SET_ORDER);

        return $matches;
    }

    private function getParsedTemplateVariables($matches)
    {
        $templateVariables = [];
        foreach ($matches as $match) {
            $mailVariable = MailVariable::where('variable_key', $match[0])->first();

            if ($mailVariable) {
                $templateVariables[$mailVariable->variable_key] = $this->getRealVariableValue($mailVariable->variable_key, $mailVariable->variable_value);
            }
        }

        return $templateVariables;
    }

    private function replaceKeysWithValues()
    {
        return str_replace(array_keys($this->templateVariables), array_values($this->templateVariables), $this->templateStr);
    }

    private function getRealVariableValue($variableKey, $variableValue)
    {
        // if variable value not empty return it
        if ($variableValue) {
            return $variableValue;
        }

        // else look for this in the reserved variables below
        if (array_key_exists($variableKey, $this->reservedVariableKeys())) {
            return $this->reservedVariableKeys()[$variableKey];
        }

        // else if the variable key is a form input
        if (Str::contains($variableKey, "INPUT")) {
            return $this->getInputTypeVariable($variableKey, $variableValue);
        }

        // else if the key is a dynamic data variable
        if (Str::contains($variableKey, "DYNAMIC")) {
            return $this->getDynamicTypeVariable($variableKey, $variableValue);
        }

        // otherwise return the value as is
        return $variableValue;
    }

    private function getInputTypeVariable($variableKey, $variableValue)
    {
        $inputName = explode(":", str_replace("]", "", str_replace("[", "", $variableKey)))[1];

        if (request()->has($inputName)) {
            return request()->input($inputName);
        }

        return $variableValue;
    }

    private function getDynamicTypeVariable($variableKey, $variableValue)
    {
        $propertyName = explode(":", str_replace("]", "", str_replace("[", "", $variableKey)))[1];

        if (isset($this->dynamicData[$propertyName])) {
            return $this->dynamicData[$propertyName];
        }

        return $variableValue;
    }

    private function reservedVariableKeys()
    {
        // in my case i suppose i have these reserved variables
        return [
            "[WEBSITE_LOGO]" => $this->getWebsiteLogo(),
            "[WEBSITE_NAME]" => $this->getAppName(),
            "[YEAR]" => date("Y"),
            "[MESSAGE_BODY]" => $this->rawMessage,
            "[CURR_USER]" => (auth()->check() ? auth()->user()->name : ""),
        ];
    }

    private function getWebsiteLogo()
    {

        if (Auth::check()) {
            $admin_id = Auth::user()->admin_id;
            $logoUrl = CustomHelper::getCompanyLogo($admin_id);
            return '<img src="' . $logoUrl . '" width="200" height="160" alt="website logo" />';
        } else {
            $logo = CustomHelper::STAFF_AVATAR_URL . "logo-light.png";
            return '<img src="' . $logo . '" width="200" height="160" alt="website logo" />';
        }
        // return whatever your website logo

    }
    private function getAppName()
    {
        $appname = "";
        if (Auth::check()) {
            $admin_id = Auth::user()->admin_id;
            // return whatever your website logo
            $logo = AdminSetting::where('admin_id', $admin_id)->get();
            if ($logo) {
                foreach ($logo as $key => $value) {
                    if ($value->meta_key == "appname") {
                        $appname = $value->meta_value;
                    }
                }
            }
        } else {
            $appname = config('app.name');
        }
        return $appname;
    }
}

<?php
namespace App\Helpers;

use App\Mail\SendMail;
use App\Models\AdminEmail;
use App\Models\AdminEmailSetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class MailHelper
{
    public static function setMailConfig()
    {
        //Get the data from settings table
        $configuration = AdminEmailSetting::where("admin_id", Auth::user()->admin_id)->first();
        if (!is_null($configuration)) {      
            //Set the data in an array variable from settings table
            $mailConfig = [
                'transport' => $configuration->driver,
                'host' => $configuration->host,
                'port' => $configuration->port,
                'encryption' => $configuration->encryption,
                'username' => $configuration->username,
                'password' => $configuration->password,
                'timeout' => null,
            ];
            
            //To set configuration values at runtime, pass an array to the config helper
            config(['mail.mailers.smtp' => $mailConfig]);
        }
    }
    public $adminMail = "jain.vjain007@gmail.com";
    public static function StaffMail($aUser, $id)
    {
        $mailTemplate = AdminEmail::where('emailtype', $id)->first();
        $templateParser = (new TemplateParser($mailTemplate->message));
        $templateParser->username = $aUser->name;
        $templateParser->email = $aUser->email;
        $templateParser->password = $aUser->password;
        $templateParser->process();
        MailHelper::setMailConfig();
        Mail::to($aUser->email)->send(new SendMail($mailTemplate->subject, $templateParser->getCompiled()));
    }

    public static function LeadMail($aLead, $id)
    {
        $mailTemplate = AdminEmail::where('emailtype', $id)->first();
        $templateParser = (new TemplateParser($mailTemplate->message));
        $name = $aLead->first_name . $aLead->last_name;
        $templateParser->name = $name;
        $templateParser->email = $aLead->email;
        $templateParser->process();
        MailHelper::setMailConfig();
        Mail::to($aLead->email)->send(new SendMail($mailTemplate->subject, $templateParser->getCompiled()));
    }

    public static function LeadStatusMail($user, $id)
    {
        $mailTemplate = AdminEmail::where('emailtype', $id)->first();
        $templateParser = (new TemplateParser($mailTemplate->message));
        $templateParser->username = $user->first_name;
        $templateParser->email = $user->email;
        $templateParser->process();
        MailHelper::setMailConfig();
        Mail::to($user->email)->send(new SendMail($mailTemplate->subject, $templateParser->getCompiled()));
    }
    public static function ClientMail($aUser, $id)
    {
        $mailTemplate = AdminEmail::where('emailtype', $id)->first();
        $templateParser = (new TemplateParser($mailTemplate->message));
        $templateParser->username = $aUser['first_name'];
        $templateParser->email = $aUser['email'];
        $templateParser->password = $aUser['password'];
        $templateParser->process();
        MailHelper::setMailConfig();
        Mail::to($aUser['email'])->send(new SendMail($mailTemplate->subject, $templateParser->getCompiled()));
    }

    public static function ClientTicket($ticket, $id)
    {
        $mailTemplate = AdminEmail::where('emailtype', $id)->first();
        $templateParser = (new TemplateParser($mailTemplate->message));
        $templateParser->department = CustomHelper::getdepartmentName($ticket['department']);
        $templateParser->subject = $ticket['subject'];
        $templateParser->priority = CustomHelper::$getPriorityType[$ticket['priority']];
        $templateParser->tags = $ticket['tags'];
        $templateParser->message = $ticket['message'];
        $templateParser->process();
        MailHelper::setMailConfig();
        Mail::to("vaibhavj1107@gmail.com")->send(new SendMail($mailTemplate->subject, $templateParser->getCompiled()));
    }

    public static function ClientTicketStatus($tStatus, $id)
    {
        $mailTemplate = AdminEmail::where('emailtype', $id)->first();
        $templateParser = (new TemplateParser($mailTemplate->message));
        $templateParser->username = $tStatus['name'];
        $templateParser->process();
        MailHelper::setMailConfig();
        Mail::to($tStatus['email'])->send(new SendMail($mailTemplate->subject, $templateParser->getCompiled()));
    }

    public static function sendDynamicMail($data, $id)
    {
        // echo "<pre>";
        // print_r($data);
        // die;
        $mailTemplate = AdminEmail::where('emailtype', $id)->first();
        if ($mailTemplate) {
            $templateParser = (new TemplateParser($mailTemplate->message));
            $subject = $mailTemplate->subject;
        } else {
            $templateParser = (new TemplateParser($data['message']));
            $subject = $data['subject'];
        }
        if (isset($data['password'])) {
            $templateParser->password = $data['password'];
        }
        if (isset($data['name'])) {
            $templateParser->username = $data['name'];
        }
        if (isset($data['email'])) {
            $templateParser->email = $data['email'];
        }
        if (isset($data['department'])) {
            $templateParser->department = CustomHelper::getdepartmentName($data['department']);
        }
        if (isset($data['subject'])) {
            $templateParser->subject = $data['subject'];
        }
        if (isset($data['priority'])) {
            $templateParser = CustomHelper::$getPriorityType[$data['priority']];
        }
        if (isset($data['tags'])) {
            $templateParser->tags = $data['tags'];
        }
        if (isset($data['message'])) {
            $templateParser->message = $data['message'];
        }
        $templateParser->process();
        // echo "<pre>";
        // print_r($templateParser);
        // die;
        MailHelper::setMailConfig();
        Mail::to($data['email'])->send(new SendMail($subject, $templateParser->getCompiled()));
    }

}

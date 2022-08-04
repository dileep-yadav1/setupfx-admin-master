@extends('layouts.master')

@section('title') Theme Setting @endsection

@section('content')

    @include('layouts.setting_sidebar')
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST"  action="{{ route('setting.store', $settingId) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Company Name</label>
                        <input type="text" id="company_name" name="company_name" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['company_name'] : old('company_name') }}" placeholder="Company Name">
                        @if ($errors->has('company_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Legal Name</label>
                        <input type="text" id="legal_name" name="legal_name" class="form-control{{ $errors->has('legal_name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['legal_name'] : old('legal_name') }}" placeholder="Legal Name">
                        @if ($errors->has('legal_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('legal_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Contact Person</label>
                        <input type="text" id="contact_person" name="contact_person" class="form-control{{ $errors->has('contact_person') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['contact_person'] : old('contact_person') }}" placeholder="Contact Person">
                        @if ($errors->has('contact_person'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('contact_person') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Company Address</label>
                        <textarea name="company_address" id="company_address" class="form-control{{ $errors->has('company_address') ? ' is-invalid' : '' }}" rows="5">{{ $aRow ? $aRow['company_address'] : old('company_address') }}</textarea>
                        @if ($errors->has('company_address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company_address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">ZipCode</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['zipcode'] : old('zipcode') }}" placeholder="Zipcode">
                        @if ($errors->has('zipcode'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('zipcode') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">City</label>
                        <input type="text" id="city" name="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['city'] : old('city') }}" placeholder="City">
                        @if ($errors->has('city'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">State</label>
                        <input type="text" id="state" name="state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['state'] : old('state') }}" placeholder="State">
                        @if ($errors->has('state'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Country</label>
                        <input type="text" id="country" name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['country'] : old('country') }}" placeholder="Country">
                        @if ($errors->has('country'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Website</label>
                        <input type="text" id="website" name="website" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['website'] : old('website') }}" placeholder="Website">
                        @if ($errors->has('website'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('website') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Company Email</label>
                        <input type="text" id="company_email" name="company_email" class="form-control{{ $errors->has('company_email') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['company_email'] : old('company_email') }}" placeholder="Company Email">
                        @if ($errors->has('company_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company_email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Company Phone</label>
                        <input type="text" id="company_phone" name="company_phone" class="form-control{{ $errors->has('company_phone') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['company_phone'] : old('company_phone') }}" placeholder="Company Phone">
                        @if ($errors->has('company_phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company_phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Fax</label>
                        <input type="text" id="fax" name="fax" class="form-control{{ $errors->has('fax') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['fax'] : old('fax') }}" placeholder="">
                        @if ($errors->has('fax'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('fax') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Company Registration</label>
                        <input type="text" id="company_registration" name="company_registration" class="form-control{{ $errors->has('company_registration') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['company_registration'] : old('company_registration') }}" placeholder="">
                        @if ($errors->has('company_registration'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company_registration') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Tax Number</label>
                        <input type="text" id="tax_number" name="tax_number" class="form-control{{ $errors->has('tax_number') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['tax_number'] : old('tax_number') }}" placeholder="">
                        @if ($errors->has('tax_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tax_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Email Signature</label>
                        <input type="text" id="email_signature" name="email_signature" class="form-control{{ $errors->has('email_signature') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['email_signature'] : old('email_signature') }}" placeholder="">
                        @if ($errors->has('email_signature'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email_signature') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Terms and Conditions Link(Client Portal)</label>
                        <input type="text" id="terms_condition_client" name="terms_condition_client" class="form-control{{ $errors->has('terms_condition_client') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['terms_condition_client'] : old('terms_condition_client') }}" placeholder="">
                        @if ($errors->has('terms_condition_client'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('terms_condition_client') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Terms and Conditions Link(Partner Portal)</label>
                        <input type="text" id="terms_condition_partner" name="terms_condition_partner" class="form-control{{ $errors->has('terms_condition_partner') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['terms_condition_partner'] : old('terms_condition_partner') }}" placeholder="">
                        @if ($errors->has('terms_condition_partner'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('terms_condition_partner') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">About us Link</label>
                        <input type="text" id="about-us" name="about-us" class="form-control{{ $errors->has('about-us') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['about-us'] : old('about-us') }}" placeholder="About us Link">
                        @if ($errors->has('about-us'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('about-us') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Privacy Policy Link</label>
                        <input type="text" id="privacy_policy_link" name="privacy_policy_link" class="form-control{{ $errors->has('privacy_policy_link') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['privacy_policy_link'] : old('privacy_policy_link') }}" placeholder="Privacy Policy Link">
                        @if ($errors->has('privacy_policy_link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('privacy_policy_link') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Facebook Link</label>
                        <input type="text" id="facebook_link" name="facebook_link" class="form-control{{ $errors->has('facebook_link') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['facebook_link'] : old('facebook_link') }}" placeholder="Facebook Link">
                        @if ($errors->has('facebook_link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('facebook_link') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Linkedin Link</label>
                        <input type="text" id="linkedin_link" name="linkedin_link" class="form-control{{ $errors->has('linkedin_link') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['linkedin_link'] : old('linkedin_link') }}" placeholder="Linkedin Link">
                        @if ($errors->has('linkedin_link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('linkedin_link') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Youtube Link</label>
                        <input type="text" id="youtube_link" name="youtube_link" class="form-control{{ $errors->has('youtube_link') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['youtube_link'] : old('youtube_link') }}" placeholder="Youtube Link">
                        @if ($errors->has('youtube_link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('youtube_link') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Instagram Link</label>
                        <input type="text" id="instagram_link" name="instagram_link" class="form-control{{ $errors->has('instagram_link') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['instagram_link'] : old('instagram_link') }}" placeholder="Instagram Link">
                        @if ($errors->has('instagram_link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('instagram_link') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Declaimer Statement</label>
                        <textarea name="disclaimer_statement" id="disclaimer_statement" class="form-control{{ $errors->has('disclaimer_statement') ? ' is-invalid' : '' }}" rows="5">{{ $aRow ? $aRow['disclaimer_statement'] : old('disclaimer_statement') }}</textarea>
                        @if ($errors->has('disclaimer_statement'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('disclaimer_statement') }}</strong>
                            </span>
                        @endif
                    </div>

                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
        <!-- end card body -->
        </div>
    <!-- end card -->
    </div>
</div>

@endsection

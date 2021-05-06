@extends('layouts.auth', ['main_columns' => 'col-md-10 col-lg-9 col-xl-8'])

@section('meta')
    <title>{{ __('Install') }} &raquo; {{ __('Configure') }} | {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-primary">{{ __('Configure') }}</h5>
            <p class="card-text">
                {{ __('Please enter configuration values carefully or else it could result in installation failure.') }}
            </p>
        </div>
        <form action="" enctype="multipart/form-data" method="post">
            @csrf
            <div class="card-body border-top">
                <div class="form-group">
                    <label for="configure-purchase-code">
                        {{ __('Purchase code') }} <span class="text-danger">&ast;</span>
                    </label>
                    <input class="form-control @error('PURCHASE_CODE') is-invalid @enderror" id="configure-purchase-code" name="PURCHASE_CODE" required value="{{ old('PURCHASE_CODE', config('fixtures.purchase_code')) }}">
                    @error('PURCHASE_CODE')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">{{ __('You can find this in your license certificate from the Downloads page in CodeCanyon.') }}</small>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="configure-app-name">
                                {{ __('Name') }} <span class="text-danger">&ast;</span>
                            </label>
                            <input class="form-control @error('APP_NAME') is-invalid @enderror" id="configure-app-name" name="APP_NAME" required value="{{ old('APP_NAME', config('app.name')) }}">
                            @error('APP_NAME')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">{{ __('This is the name of the app shown everywhere in admin panel and outgoing emails.') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="configure-app-url">
                                {{ __('URL') }} <span class="text-danger">&ast;</span>
                            </label>
                            <input class="form-control @error('APP_URL') is-invalid @enderror" id="configure-app-url" name="APP_URL" required value="{{ old('APP_URL', rtrim(url('/'), '/')) }}">
                            @error('APP_URL')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="configure-app-timezone">
                                {{ __('Timezone') }} <span class="text-danger">&ast;</span>
                            </label>
                            <select class="form-control @error('APP_TIMEZONE') is-invalid @enderror" id="configure-app-timezone" name="APP_TIMEZONE" required>
                                @php
                                    $old_timezone = old('APP_TIMEZONE', config('app.timezone'));
                                @endphp
                                @foreach (timezone_identifiers_list() as $timezone)
                                    <option value="{{ $timezone }}" @if ($timezone === $old_timezone) selected @endif>{{ $timezone }}</option>
                                @endforeach
                            </select>
                            @error('APP_TIMEZONE')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-md-0">
                            <label for="configure-api-key">
                                {{ __('API key') }} <span class="text-danger">&ast;</span>
                            </label>
                            @php
                                $old_api_key = config('fixtures.api_key');
                                if (empty($old_api_key)) {
                                    $old_api_key = Str::upper(Str::random(32));
                                }
                            @endphp
                            <input class="form-control @error('API_KEY') is-invalid @enderror" id="configure-api-key" name="API_KEY" readonly value="{{ old('API_KEY', $old_api_key) }}">
                            @error('API_KEY')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                {{ __('This is a random, generated key to secure API from direct access.') }}
                                {{ __('You should copy this value as you may need this to correctly configure the app as well.') }}
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="configure-db-host">
                                {{ __('Database host & port') }} <span class="text-danger">&ast;</span>
                            </label>
                            <div class="input-group @if ($errors->has('DB_HOST') || $errors->has('DB_PORT')) is-invalid @endif">
                                <input class="form-control @error('DB_HOST') is-invalid @enderror" id="configure-db-host" name="DB_HOST" required value="{{ old('DB_HOST', config('database.connections.mysql.host')) }}">
                                <input class="form-control @error('DB_PORT') is-invalid @enderror" id="configure-db-port" name="DB_PORT" required type="number" value="{{ old('DB_PORT', config('database.connections.mysql.port')) }}">
                            </div>
                            @error('DB_HOST')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('DB_PORT')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="configure-db-database">
                                {{ __('Database name') }} <span class="text-danger">&ast;</span>
                            </label>
                            <input class="form-control @error('DB_DATABASE') is-invalid @enderror" id="configure-db-database" name="DB_DATABASE" required value="{{ old('DB_DATABASE') }}">
                            @error('DB_DATABASE')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label for="configure-db-username">
                                {{ __('Database username & password') }} <span class="text-danger">&ast;</span>
                            </label>
                            <div class="input-group @if ($errors->has('DB_USERNAME') || $errors->has('DB_PASSWORD')) is-invalid @endif">
                                <input class="form-control @error('DB_USERNAME') is-invalid @enderror" id="configure-db-username" name="DB_USERNAME" required value="{{ old('DB_USERNAME') }}">
                                <input class="form-control @error('DB_PASSWORD') is-invalid @enderror" id="configure-db-password" name="DB_PASSWORD" required type="password">
                            </div>
                            @error('DB_USERNAME')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('DB_PASSWORD')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="configure-facebook-app-id">{{ __('Facebook app ID') }}</label>
                            <input class="form-control @error('FACEBOOK_APP_ID') is-invalid @enderror" id="configure-facebook-app-id" name="FACEBOOK_APP_ID" value="{{ old('FACEBOOK_APP_ID') }}">
                            @error('FACEBOOK_APP_ID')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-md-0">
                            <label for="configure-facebook-app-secret">{{ __('Facebook app secret') }}</label>
                            <input class="form-control @error('FACEBOOK_APP_SECRET') is-invalid @enderror" id="configure-facebook-app-secret" name="FACEBOOK_APP_SECRET" value="{{ old('FACEBOOK_APP_SECRET') }}">
                            @error('FACEBOOK_APP_SECRET')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label for="configure-google-client-id">{{ __('Google client ID') }}</label>
                            <input class="form-control @error('GOOGLE_CLIENT_ID') is-invalid @enderror" id="configure-google-client-id" name="GOOGLE_CLIENT_ID" value="{{ old('GOOGLE_CLIENT_ID') }}">
                            @error('GOOGLE_CLIENT_ID')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                {{ __('This must be client ID of the OAuth 2.0 client with type "3" in the google-services.json file downloaded from Firebase console.') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-md-0">
                            <label for="configure-firebase-credentials">{{ __('Firebase credentials') }}</label>
                            <div class="custom-file">
                                <input class="custom-file-input @error('FIREBASE_CREDENTIALS') is-invalid @enderror" id="configure-firebase-credentials" name="FIREBASE_CREDENTIALS" type="file">
                                <label class="custom-file-label" for="configure-firebase-credentials">{{ __('Choose file') }}&hellip;</label>
                                @error('FIREBASE_CREDENTIALS')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    {{ __('This must be the key file (in JSON format) associated with your Firebase project service account.') }}
                                    {{ __('You can generate/download it from Firebase console.') }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @php
                            $old_otp_service = old('OTP_SERVICE', config('fixtures.otp_service'))
                        @endphp
                        <div class="form-group mb-0">
                            <label for="configure-otp-service">{{ __('OTP service') }} <span class="text-danger">&ast;</span></label>
                            <select class="form-control @error('OTP_SERVICE') is-invalid @enderror" id="configure-otp-service" name="OTP_SERVICE" required>
                                <option value="firebase" @if ($old_otp_service === 'firebase') selected @endif>{{ __('Firebase') }}</option>
                                <option value="twilio" @if ($old_otp_service === 'twilio') selected @endif>{{ __('Twilio') }}</option>
                                <option value="msg91" @if ($old_otp_service === 'msg91') selected @endif>{{ __('MSG91') }}</option>
                            </select>
                            @error('OTP_SERVICE')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 @if ($old_otp_service !== 'twilio') d-none @endif" data-toggle-if="#configure-otp-service,twilio,d-none">
                            <div class="form-group">
                                <label for="configure-twilio-sid">{{ __('Twilio SID') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('TWILIO_SID') is-invalid @enderror" id="configure-twilio-sid" name="TWILIO_SID" value="{{ old('TWILIO_SID') }}">
                                @error('TWILIO_SID')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="configure-twilio-auth-token">{{ __('Twilio auth token') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('TWILIO_AUTH_TOKEN') is-invalid @enderror" id="configure-twilio-auth-token" name="TWILIO_AUTH_TOKEN" value="{{ old('TWILIO_AUTH_TOKEN') }}">
                                @error('TWILIO_AUTH_TOKEN')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="configure-twilio-verify-sid">{{ __('Twilio verify SID') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('TWILIO_VERIFY_SID') is-invalid @enderror" id="configure-twilio-verify-sid" name="TWILIO_VERIFY_SID" value="{{ old('TWILIO_VERIFY_SID') }}">
                                @error('TWILIO_VERIFY_SID')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3 @if ($old_otp_service !== 'msg91') d-none @endif" data-toggle-if="#configure-otp-service,msg91,d-none">
                            <div class="form-group mb-0">
                                <label for="configure-msg91-auth-key">{{ __('MSG91 auth key') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('MSG91_AUTH_KEY') is-invalid @enderror" id="configure-msg91-auth-key" name="MSG91_AUTH_KEY" value="{{ old('MSG91_AUTH_KEY') }}">
                                @error('OTP_SERVICE')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-6">
                        @php
                            $old_filesystem_cloud = old('FILESYSTEM_CLOUD', config('filesystems.cloud'))
                        @endphp
                        <div class="form-group mb-md-0">
                            <label for="configure-filesystem-cloud">{{ __('Filesystem driver') }} <span class="text-danger">&ast;</span></label>
                            <select class="form-control @error('FILESYSTEM_CLOUD') is-invalid @enderror" id="configure-filesystem-cloud" name="FILESYSTEM_CLOUD" required>
                                <option value="public" @if ($old_filesystem_cloud === 'public') selected @endif>{{ __('Public') }}</option>
                                <option value="s3" @if ($old_filesystem_cloud === 's3') selected @endif>{{ __('S3, DigitalOcean or Backblaze') }}</option>
                                <option value="gcs" @if ($old_filesystem_cloud === 'gcs') selected @endif>{{ __('Google Cloud') }}</option>
                            </select>
                            @error('FILESYSTEM_CLOUD')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 @if ($old_filesystem_cloud !== 's3') d-none @endif" data-toggle-if="#configure-filesystem-cloud,s3,d-none">
                            <div class="form-group">
                                <label for="configure-aws-access-publishable-key">{{ __('Key ID & secret') }} <span class="text-danger">&ast;</span></label>
                                <div class="input-group">
                                    <input class="form-control @error('AWS_ACCESS_KEY_ID') is-invalid @enderror" id="configure-aws-access-key-id" name="AWS_ACCESS_KEY_ID" value="{{ old('AWS_ACCESS_KEY_ID') }}">
                                    <input class="form-control @error('AWS_SECRET_ACCESS_KEY') is-invalid @enderror" id="configure-aws-secret-access-key" name="AWS_SECRET_ACCESS_KEY" value="{{ old('AWS_SECRET_ACCESS_KEY') }}">
                                </div>
                                @error('AWS_ACCESS_KEY_ID')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('AWS_SECRET_ACCESS_KEY')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    {{ __('For DigitalOcean, you can generate these in Account > API > Spaces access keys.') }}
                                    {{ __('For Backblaze, you can create these in App Keys > Add a New Application Key.') }}
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="configure-aws-bucket">{{ __('Bucket or Space') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('AWS_BUCKET') is-invalid @enderror" id="configure-aws-bucket" name="AWS_BUCKET" value="{{ old('AWS_BUCKET') }}">
                                @error('AWS_BUCKET')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="configure-aws-default-region">{{ __('Region') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('AWS_DEFAULT_REGION') is-invalid @enderror" id="configure-aws-default-region" name="AWS_DEFAULT_REGION" value="{{ old('AWS_DEFAULT_REGION') }}">
                                @error('AWS_DEFAULT_REGION')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="configure-aws-endpoint">{{ __('Endpoint') }}</label>
                                <input class="form-control @error('AWS_ENDPOINT') is-invalid @enderror" id="configure-aws-endpoint" name="AWS_ENDPOINT" value="{{ old('AWS_ENDPOINT') }}">
                                @error('AWS_ENDPOINT')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    {{ __('This is only required when using S3 driver with DigitalOcean or Backblaze and must start with https://...') }}
                                    {{ __('For usage with S3 directly, leave it blank.') }}
                                </small>
                            </div>
                        </div>
                        <div class="mt-3 @if ($old_filesystem_cloud !== 'gcs') d-none @endif" data-toggle-if="#configure-filesystem-cloud,gcs,d-none">
                            <div class="form-group">
                                <label for="configure-google-application-credentials">
                                    {{ __('Google application credentials') }} <span class="text-danger">&ast;</span>
                                </label>
                                <div class="custom-file">
                                    <input class="custom-file-input @error('GOOGLE_APPLICATION_CREDENTIALS') is-invalid @enderror" id="configure-google-application-credentials" name="GOOGLE_APPLICATION_CREDENTIALS" type="file">
                                    <label class="custom-file-label" for="configure-google-application-credentials">{{ __('Choose file') }}&hellip;</label>
                                    @error('GOOGLE_APPLICATION_CREDENTIALS')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="configure-gcs-project-id">{{ __('GCS project ID') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('GOOGLE_CLOUD_PROJECT_ID') is-invalid @enderror" id="configure-gcs-project-id" name="GOOGLE_CLOUD_PROJECT_ID" value="{{ old('GOOGLE_CLOUD_PROJECT_ID') }}">
                                @error('GOOGLE_CLOUD_PROJECT_ID')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    {{ __('This is the unique project ID for your Google Cloud project e.g., muly-1234567890.') }}
                                </small>
                            </div>
                            <div class="form-group mb-0">
                                <label for="configure-gcs-bucket">{{ __('GCS bucket') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('GOOGLE_CLOUD_STORAGE_BUCKET') is-invalid @enderror" id="configure-gcs-bucket" name="GOOGLE_CLOUD_STORAGE_BUCKET" value="{{ old('GOOGLE_CLOUD_STORAGE_BUCKET') }}">
                                @error('GOOGLE_CLOUD_STORAGE_BUCKET')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @php
                            $old_ranking_algorithm = old('RANKING_ALGORITHM', config('fixtures.ranking_algorithm'))
                        @endphp
                        <div class="form-group">
                            <label for="configure-ranking-algorithm">{{ __('Ranking algorithm') }} <span class="text-danger">&ast;</span></label>
                            <select class="form-control @error('RANKING_ALGORITHM') is-invalid @enderror" id="configure-ranking-algorithm" name="RANKING_ALGORITHM" required>
                                <option value="sequential" @if ($old_ranking_algorithm === 'sequential') selected @endif>{{ __('Sequential') }}</option>
                                <option value="random" @if ($old_ranking_algorithm === 'random') selected @endif>{{ __('Random') }}</option>
                            </select>
                            @error('RANKING_ALGORITHM')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @php
                            $old_queue_connection = old('QUEUE_CONNECTION', config('queue.default'))
                        @endphp
                        <div class="form-group">
                            <label for="configure-queue-connection">{{ __('Queue driver') }} <span class="text-danger">&ast;</span></label>
                            <select class="form-control @error('QUEUE_CONNECTION') is-invalid @enderror" id="configure-queue-connection" name="QUEUE_CONNECTION" required>
                                <option value="sync" @if ($old_queue_connection === 'sync') selected @endif>{{ __('Synchronous') }}</option>
                                <option value="redis" @if ($old_queue_connection === 'redis') selected @endif>{{ __('Redis') }}</option>
                            </select>
                            @error('QUEUE_CONNECTION')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                {{ __('Setting this to "redis" allows server to use background job queues for various time consuming tasks and enhance response times.') }}
                                {{ __('It requires Redis to be installed and a worker manager e.g., Supervisor configured to actually run the job queue.') }}
                            </small>
                        </div>
                        @php
                            $old_cache_driver = old('CACHE_DRIVER', config('cache.default'))
                        @endphp
                        <div class="form-group mb-md-0">
                            <label for="configure-cache-driver">{{ __('Cache driver') }} <span class="text-danger">&ast;</span></label>
                            <select class="form-control @error('CACHE_DRIVER') is-invalid @enderror" id="configure-cache-driver" name="CACHE_DRIVER" required>
                                <option value="file" @if ($old_cache_driver === 'file') selected @endif>{{ __('File') }}</option>
                                <option value="redis" @if ($old_cache_driver === 'redis') selected @endif>{{ __('Redis') }}</option>
                            </select>
                            @error('CACHE_DRIVER')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                {{ __('Setting this to "redis" can significantly increase performance as this script does a lot of caching.') }}
                                {{ __('It requires Redis to be installed and more RAM to be available on server.') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-6">
                        @php
                            $old_screening_service = old('SCREENING_SERVICE', config('fixtures.screening_service'))
                        @endphp
                        <div class="form-group mb-0">
                            <label for="configure-screening-service">{{ __('Screening service') }}</label>
                            <select class="form-control @error('SCREENING_SERVICE') is-invalid @enderror" id="configure-screening-service" name="SCREENING_SERVICE">
                                <option value="" @if (empty($old_screening_service)) selected @endif>{{ __('None') }}</option>
                                <option value="manual" @if ($old_screening_service === 'manual') selected @endif>{{ __('Manual') }}</option>
                                <option value="aws" @if ($old_screening_service === 'aws') selected @endif>{{ __('AWS Rekognition') }}</option>
                                <option value="gcp" @if ($old_screening_service === 'gcp') selected @endif>{{ __('Google Cloud Video Intelligence') }}</option>
                                <option value="sightengine" @if ($old_screening_service === 'sightengine') selected @endif>{{ __('Sightengine') }}</option>
                            </select>
                            @error('SCREENING_SERVICE')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                {{ __('This enables automatic porn content detection.') }}
                                {{ __('To use AWS Rekognition, you must use AWS S3 as your filesystem driver.') }}
                                {{ __('Similarly, to use Google Cloud Video Storage, you must use GCS or Google Cloud Storage as your filesystem driver.') }}
                                {{ __('Sightengine works regardless of filesystem driver.') }}
                            </small>
                        </div>
                        <div class="mt-3 @if ($old_screening_service !== 'sightengine') d-none @endif" data-toggle-if="#configure-screening-service,sightengine,d-none">
                            <div class="form-group">
                                <label for="configure-sightengine-api-user">{{ __('API user') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('SIGHTENGINE_API_USER') is-invalid @enderror" id="configure-sightengine-api-user" name="SIGHTENGINE_API_USER" value="{{ old('SIGHTENGINE_API_USER') }}">
                                @error('SIGHTENGINE_API_USER')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="configure-sightengine-api-secret">{{ __('API secret') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('SIGHTENGINE_API_SECRET') is-invalid @enderror" id="configure-sightengine-api-secret" name="SIGHTENGINE_API_SECRET" value="{{ old('SIGHTENGINE_API_SECRET') }}">
                                @error('SIGHTENGINE_API_SECRET')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            @php
                                $old_gifts_enabled = old('GIFTS_ENABLED');
                            @endphp
                            <div class="custom-control custom-switch">
                                <input class="custom-control-input" id="configure-gifts-enabled" name="GIFTS_ENABLED" type="checkbox" value="1" @if ($old_gifts_enabled) checked @endif>
                                <label class="custom-control-label" for="configure-gifts-enabled">{{ __('Gifts enabled?') }}</label>
                            </div>
                            @error('GIFTS_ENABLED')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @php
                            $old_payment_gateway = old('PAYMENT_GATEWAY')
                        @endphp
                        <div class="mt-3 @if (empty($old_gifts_enabled)) d-none @endif" data-toggle-if="#configure-gifts-enabled,1,d-none">
                            <div class="form-group">
                                <label for="configure-payment-currency">{{ __('Payment currency') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('PAYMENT_CURRENCY') is-invalid @enderror" id="configure-payment-currency" name="PAYMENT_CURRENCY" value="{{ old('PAYMENT_CURRENCY', config('fixtures.payment_currency')) }}">
                                @error('PAYMENT_CURRENCY')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    {{ __('This is currency shown and used with payment methods. Enter 3-digit ISO code e.g., INR for Indian Rupee or USD for U. S. Dollar.') }}
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="configure-payment-gateway">{{ __('Payment gateway') }} <span class="text-danger">&ast;</span></label>
                                <select class="form-control @error('PAYMENT_GATEWAY') is-invalid @enderror" id="configure-payment-gateway" name="PAYMENT_GATEWAY">
                                    <option value="" @if (empty($old_payment_gateway)) selected @endif>{{ __('None') }}</option>
                                    @foreach(config('fixtures.payment_gateways') as $code => $name)
                                        <option value="{{ $code }}" @if ($old_payment_gateway === $code) selected @endif>{{ $name  }}</option>
                                    @endforeach
                                </select>
                                @error('PAYMENT_GATEWAY')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="@if ($old_payment_gateway !== 'play_store') d-none @endif" data-toggle-if="#configure-payment-gateway,play_store,d-none">
                                <div class="form-group">
                                    <label for="configure-google-play-credentials">
                                        {{ __('Google play credentials') }} <span class="text-danger">&ast;</span>
                                    </label>
                                    <div class="custom-file">
                                        <input class="custom-file-input @error('GOOGLE_PLAY_CREDENTIALS') is-invalid @enderror" id="configure-google-play-credentials" name="GOOGLE_PLAY_CREDENTIALS" type="file">
                                        <label class="custom-file-label" for="configure-google-play-credentials">{{ __('Choose file') }}&hellip;</label>
                                        @error('GOOGLE_PLAY_CREDENTIALS')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            {{ __('This is the JSON key file for the service account connected with your Google Play Developer Account.') }}
                                            {{ __('You can generate this from Play Store > Settings > Developer account > API access > Choose a project to link > Create new service account.') }}
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="configure-google-play-package-name">{{ __('Package name') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('GOOGLE_PLAY_PACKAGE_NAME') is-invalid @enderror" id="configure-google-play-package-name" name="GOOGLE_PLAY_PACKAGE_NAME" value="{{ old('GOOGLE_PLAY_PACKAGE_NAME') }}">
                                    @error('GOOGLE_PLAY_PACKAGE_NAME')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        {{ __('This is package name of your app in Play Store.') }}
                                    </small>
                                </div>
                            </div>
                            <div class="@if ($old_payment_gateway !== 'bitpay') d-none @endif" data-toggle-if="#configure-payment-gateway,bitpay,d-none">
                                <div class="form-group">
                                    <label for="configure-bitpay-token">{{ __('BitPay token') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('BITPAY_TOKEN') is-invalid @enderror" id="configure-bitpay-token" name="BITPAY_TOKEN" value="{{ old('BITPAY_TOKEN') }}">
                                    @error('BITPAY_TOKEN')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        {{ __('You can generate this in BitPay > Payment Tools > API Token > Add New Token in Tokens sections.') }}
                                    </small>
                                </div>
                            </div>
                            <div class="@if ($old_payment_gateway !== 'instamojo') d-none @endif" data-toggle-if="#configure-payment-gateway,instamojo,d-none">
                                <div class="form-group">
                                    <label for="configure-instamojo-client-id">{{ __('Client ID') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('INSTAMOJO_CLIENT_ID') is-invalid @enderror" id="configure-instamojo-client-id" name="INSTAMOJO_CLIENT_ID" value="{{ old('INSTAMOJO_CLIENT_ID') }}">
                                    @error('INSTAMOJO_CLIENT_ID')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="configure-instamojo-client-secret">{{ __('Client secret') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('INSTAMOJO_CLIENT_SECRET') is-invalid @enderror" id="configure-instamojo-client-secret" name="INSTAMOJO_CLIENT_SECRET" value="{{ old('INSTAMOJO_CLIENT_SECRET') }}">
                                    @error('INSTAMOJO_CLIENT_SECRET')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="@if ($old_payment_gateway !== 'paypal') d-none @endif" data-toggle-if="#configure-payment-gateway,paypal,d-none">
                                <div class="form-group">
                                    <label for="configure-paypal-client-id">{{ __('Client ID') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('PAYPAL_CLIENT_ID') is-invalid @enderror" id="configure-paypal-client-id" name="PAYPAL_CLIENT_ID" value="{{ old('PAYPAL_CLIENT_ID') }}">
                                    @error('PAYPAL_CLIENT_ID')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="configure-paypal-client-secret">{{ __('Client secret') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('PAYPAL_CLIENT_SECRET') is-invalid @enderror" id="configure-paypal-client-secret" name="PAYPAL_CLIENT_SECRET" value="{{ old('PAYPAL_CLIENT_SECRET') }}">
                                    @error('PAYPAL_CLIENT_SECRET')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class=@if ($old_payment_gateway !== 'razorpay') d-none @endif" data-toggle-if="#configure-payment-gateway,razorpay,d-none">
                                <div class="form-group">
                                    <label for="configure-razorpay-key-id">{{ __('Key ID') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('RAZORPAY_KEY_ID') is-invalid @enderror" id="configure-razorpay-key-id" name="RAZORPAY_KEY_ID" value="{{ old('RAZORPAY_KEY_ID') }}">
                                    @error('RAZORPAY_KEY_ID')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="configure-razorpay-key-secret">{{ __('Key secret') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('RAZORPAY_KEY_SECRET') is-invalid @enderror" id="configure-razorpay-key-secret" name="RAZORPAY_KEY_SECRET" value="{{ old('RAZORPAY_KEY_SECRET') }}">
                                    @error('RAZORPAY_KEY_SECRET')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="@if ($old_payment_gateway !== 'stripe') d-none @endif" data-toggle-if="#configure-payment-gateway,stripe,d-none">
                                <div class="form-group">
                                    <label for="configure-stripe-publishable-key">{{ __('Publishable key') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('STRIPE_PUBLISHABLE_KEY') is-invalid @enderror" id="configure-stripe-publishable-key" name="STRIPE_PUBLISHABLE_KEY" value="{{ old('STRIPE_PUBLISHABLE_KEY') }}">
                                    @error('STRIPE_PUBLISHABLE_KEY')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="configure-stripe-secret-key">{{ __('Secret key') }} <span class="text-danger">&ast;</span></label>
                                    <input class="form-control @error('STRIPE_SECRET_KEY') is-invalid @enderror" id="configure-stripe-secret-key" name="STRIPE_SECRET_KEY" value="{{ old('STRIPE_SECRET_KEY') }}">
                                    @error('STRIPE_SECRET_KEY')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                @php
                                    $old_referral_enabled = old('REFERRAL_ENABLED');
                                @endphp
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="configure-referral-enabled" name="REFERRAL_ENABLED" type="checkbox" value="1" @if ($old_referral_enabled) checked @endif>
                                    <label class="custom-control-label" for="configure-referral-enabled">{{ __('Referral enabled?') }}</label>
                                </div>
                                @error('REFERRAL_ENABLED')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3 @if (empty($old_referral_enabled)) d-none @endif" data-toggle-if="#configure-referral-enabled,1,d-none">
                                <div class="form-group mb-0">
                                    <label for="configure-referral-reward">{{ __('Referral reward') }} <span class="text-danger">&ast;</span></label>
                                    <div class="input-group @error('REFERRAL_REWARD') is-invalid @enderror">
                                        <input class="form-control @error('REFERRAL_REWARD') is-invalid @enderror" id="configure-referral-reward" name="REFERRAL_REWARD" type="number" value="{{ old('REFERRAL_REWARD', config('fixtures.referral_reward')) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ __('Credits') }}</span>
                                        </div>
                                    </div>
                                    @error('REFERRAL_REWARD')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        {{ __('This is the number of credits a user will earn on every successful referral i.e., new registration.') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-6">
                        @php
                            $old_mail_driver = old('MAIL_DRIVER', config('mail.driver'))
                        @endphp
                        <div class="form-group">
                            <label for="configure-mail-driver">{{ __('Mail driver') }} <span class="text-danger">&ast;</span></label>
                            <select class="form-control @error('MAIL_DRIVER') is-invalid @enderror" id="configure-mail-driver" name="MAIL_DRIVER" required>
                                <option value="sendmail" @if ($old_mail_driver === 'sendmail') selected @endif>{{ __('Sendmail') }}</option>
                                <option value="smtp" @if ($old_mail_driver === 'smtp') selected @endif>{{ __('SMTP') }}</option>
                                <option value="mailgun" @if ($old_mail_driver === 'mailgun') selected @endif>{{ __('Mailgun') }}</option>
                            </select>
                            @error('MAIL_DRIVER')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="@if ($old_mail_driver !== 'smtp') d-none @endif" data-toggle-if="#configure-mail-driver,smtp,d-none">
                            <div class="form-group">
                                <label for="configure-mail-host">{{ __('SMTP host') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('MAIL_HOST') is-invalid @enderror" id="configure-mail-host" name="MAIL_HOST" value="{{ old('MAIL_HOST', config('mail.host')) }}">
                                @error('MAIL_HOST')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="configure-mail-port">{{ __('SMTP port') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('MAIL_PORT') is-invalid @enderror" id="configure-mail-port" name="MAIL_PORT" type="number" value="{{ old('MAIL_PORT', config('mail.port')) }}">
                                @error('MAIL_PORT')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="configure-mail-username">{{ __('SMTP username') }}</label>
                                <input class="form-control @error('MAIL_USERNAME') is-invalid @enderror" id="configure-mail-username" name="MAIL_USERNAME" value="{{ old('MAIL_USERNAME') }}">
                                @error('MAIL_USERNAME')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="configure-mail-password">{{ __('SMTP password') }}</label>
                                <input class="form-control @error('MAIL_PASSWORD') is-invalid @enderror" id="configure-mail-password" name="MAIL_PASSWORD" type="password">
                                @error('MAIL_PASSWORD')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @php
                                $old_mail_encryption = old('MAIL_ENCRYPTION', config('mail.encryption'))
                            @endphp
                            <div class="form-group">
                                <label for="configure-mail-encryption">{{ __('SMTP encryption') }}</label>
                                <select class="form-control @error('MAIL_ENCRYPTION') is-invalid @enderror" id="configure-mail-encryption" name="MAIL_ENCRYPTION">
                                    <option value="" @if (empty($old_mail_encryption)) selected @endif>{{ __('None') }}</option>
                                    <option value="ssl" @if ($old_mail_encryption === 'ssl') selected @endif>{{ __('SSL') }}</option>
                                    <option value="tls" @if ($old_mail_encryption === 'tls') selected @endif>{{ __('TLS') }}</option>
                                </select>
                                @error('MAIL_ENCRYPTION')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="@if ($old_mail_driver !== 'mailgun') d-none @endif" data-toggle-if="#configure-mail-driver,mailgun,d-none">
                            <div class="form-group">
                                <label for="configure-mailgun-domain">{{ __('Mailgun domain') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('MAILGUN_DOMAIN') is-invalid @enderror" id="configure-mailgun-domain" name="MAILGUN_DOMAIN" value="{{ old('MAILGUN_DOMAIN') }}">
                                @error('MAILGUN_DOMAIN')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    {{ __('This is the domain you may have already verified with Mailgun e.g., mg.yourapp.com etc.') }}
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="configure-mailgun-secret">{{ __('Mailgun secret') }} <span class="text-danger">&ast;</span></label>
                                <input class="form-control @error('MAILGUN_SECRET') is-invalid @enderror" id="configure-mailgun-secret" name="MAILGUN_SECRET" value="{{ old('MAILGUN_SECRET') }}">
                                @error('MAILGUN_SECRET')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="configure-mail-from-name">{{ __('From name') }} <span class="text-danger">&ast;</span></label>
                            <input class="form-control @error('MAIL_FROM_NAME') is-invalid @enderror" id="configure-mail-from-name" name="MAIL_FROM_NAME" value="{{ old('MAIL_FROM_NAME') }}">
                            @error('MAIL_FROM_NAME')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                {{ __('This will be shown to your recipients in from header.') }}
                            </small>
                        </div>
                        <div class="form-group mb-0">
                            <label for="configure-mail-from-address">{{ __('From address') }} <span class="text-danger">&ast;</span></label>
                            <input class="form-control @error('MAIL_FROM_ADDRESS') is-invalid @enderror" id="configure-mail-from-address" name="MAIL_FROM_ADDRESS" value="{{ old('MAIL_FROM_ADDRESS') }}" type="email">
                            @error('MAIL_FROM_ADDRESS')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                {{ __('This is is mostly your SMTP username e.g., dnd@example.com etc.') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="btn-toolbar">
                    <a class="btn btn-outline-dark" href="{{ route('install.overview') }}">
                        <i class="fas fa-arrow-left mr-1"></i> {{ __('Back') }}
                    </a>
                    <button class="btn btn-primary ml-auto">
                        {{ __('Continue') }} <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

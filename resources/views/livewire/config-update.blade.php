@section('meta')
    <title>{{ __('Configuration') }} - {{ __('Backend') }} | {{ config('app.name') }}</title>
@endsection

@section('styles')
    @parent
    <style>
        .CodeMirror {
            height: auto;
            border: 1px solid #ddd;
        }
        .CodeMirror-scroll {
            max-height: 512px;
        }
        .CodeMirror pre {
            padding-left: 7px;
            line-height: 1.25;
        }
    </style>
@endsection

<div>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Configuration') }}</li>
            </ol>
        </nav>
        <div class="btn-toolbar mb-3">
            <button class="btn btn-warning" wire:click="refresh" wire:loading.attr="disabled">
                <i class="fas fa-database mr-1"></i> {{ __('Cache') }}
            </button>
            @if (config('queue.default') !== 'default')
                <button class="btn btn-warning ml-1" wire:click="restart" wire:loading.attr="disabled">
                    <i class="fas fa-redo mr-1"></i> {{ __('Restart') }}
                </button>
            @endif
        </div>
        @include('partials.flash')
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="spinner-border spinner-border-sm float-right" role="status" wire:loading wire:target="update">
                    <span class="sr-only">{{ __('Loading') }}&hellip;</span>
                </div>
                <h5 class="card-title text-primary">{{ __('Configuration') }}</h5>
                <p class="card-text">{{ __('Update app environment/configuration file.') }}</p>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <form class="mb-0" wire:submit.prevent="update">
                            <div class="form-group row" wire:ignore>
                                <label class="col-sm-4 col-form-label" for="config-env">{{ __('Environment') }}</label>
                                <div class="col-sm-8">
                                    <input id="config-env-hidden" type="hidden" wire:model.defer="env">
                                    <textarea class="form-control @error('env') is-invalid @enderror" data-target="#config-env-hidden" data-widget="codemirror" id="config-env"></textarea>
                                    @error('env')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 offset-sm-4">
                                    <button class="btn btn-success">
                                        <i class="fas fa-check mr-1"></i> {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

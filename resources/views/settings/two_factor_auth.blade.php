@extends('layouts.headerSidebar')

@section('title')
    Two Factor Auth
@endsection

@section('content')
    <div class="setting-section">
        <div class="row">
            <div class="col-12">
                <div class="two-factor">
                    <h5>Enable/Disable Two Factor Auth</h5>
                    <p>If you secure your account then enable two factor authentication</p>


                    <input type="hidden" value="{{Auth::user()->enable_two_factor_auth}}">

                    <button type="button" class="btn btn-primary">{{Auth::user()->enable_two_factor_auth ?'Disable':'Enable'}}</button>

                </div>
            </div>
        </div>
    </div>
@endsection
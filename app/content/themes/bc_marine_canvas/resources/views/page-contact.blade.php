@php /* Template Name: Contact */ @endphp

@extends('layouts.app')

@section('banner', App::background_image($contact_page->banner()))
@section('title', $contact_page->name())

@section('content')
  <div class="container my-5" role="document">
    <div class="row">
      <div class="col-lg-4">
        @include('contact.address_card', [
          'info' => $contact_page->address_card(),
        ])
      </div>
      <div class="col-lg-8 pl-lg-4 contact-form">
        @include('contact.form', [
          'intro' => $contact_page->intro()['text'],
          'form' => $contact_page->form(),
        ])
      </div>
    </div>
  </div>
@endsection

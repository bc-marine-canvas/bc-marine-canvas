<div class="card">
  <div class="card-body">
    <h5 class="card-title">{{ $info['heading'] }}</h5>
    @if ($info['text'])
      <p class="card-text">{{ $info['text'] }}</p>
    @endif
    <dl>
      <dt>Address:</dt>
      <dd>
        <a href="{!! $company_address['directions_link'] !!}" target=_blank">
          {{ $company_address['address_line_1'] }}<br>
          {{ $company_address['city'] }}, {{ $company_address['state'] }} {{ $company_address['zip_code'] }}
        </a>
      </dd>
      <dt>Phone:</dt>
      <dd><a href="{{ $company_contact['phone']['href'] }}">{!! $company_contact['phone']['display'] !!}</a></dd>
      <dt>Email:</dt>
      <dd><a href="mailto:{!! $company_contact['email'] !!}">{!! $company_contact['email'] !!}</a></dd>
    </dl>
  </div>
</div>

<footer class="bg-primary">
  @if ($footer_cta['show'])
    <div class="container">
      <div class="row align-items-center justify-content-center p-4 rounded footer-cta">
        <div class="col-lg-8 col-xl-9">
          <p>{!! $footer_cta['text'] !!}</p>
        </div>
        <div class="col-lg-4 col-xl-3">
          <a class="btn btn-secondary m-0" href="{!! $footer_cta['link'] !!}">{{ $footer_cta['button_text'] }}</a>
        </div>
      </div>
    </div>
  @endif
  <div class="footer-bg">
    <div class="footer-opacity">
      <div class="container py-4">
        <div class="row my-5">
          <div class="col-lg-6">
            <div class="row no-gutters">
              <div class="col-md my-3 d-flex align-items-center footer-logo px-3">
                <img class="px-3 mx-auto" src="{!! $footer_logo['url'] !!}" height="{{ $footer_logo['height'] }}" width="{{ $footer_logo['width'] }}" alt="{!! $footer_logo['alt'] !!}">
              </div>
              <div class="col-1 footer-divider invisible"></div>
              <div class="col-md my-3 footer-quick-links">
                <h6 class="footer-heading">Quick Links</h6>
                <ul>
                  @foreach ($footer_quick_links as $link)
                    <li><a class="text-light" href="{!! $link['link']['url'] !!}">{{ $link['link']['title'] }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row no-gutters">
              <div class="col-md my-3">
                <h6 class="footer-heading">{{ $footer_contact['heading'] }}</h6>
                <p class="mb-2">
                  <a class="text-light" href="{!! $company_address['directions_link'] !!}" target=_blank">
                    {{ $company_address['address_line_1'] }}<br>
                    {{ $company_address['city'] }}, {{ $company_address['state'] }} {{ $company_address['zip_code'] }}
                  </a>
                </p>
                <p class="mb-2">Phone: <a class="text-light" href="{{ $company_contact['phone']['href'] }}">{!! $company_contact['phone']['display'] !!}</a></p>
                <p class="mb-4">Email: <a class="text-light" href="mailto:{!! $company_contact['email'] !!}">{!! $company_contact['email'] !!}</a></p>
                <p><a class="btn btn-outline-light text-uppercase font-weight-light" href="{!! $footer_contact['link'] !!}">{{ $footer_contact['button_text'] }}</a></p>
              </div>
              <div class="col-1 footer-divider invisible"></div>
              <div class="col-md my-3">
                <h6 class="footer-heading">{{ $footer_social['heading'] }}</h6>
                <p class="text-light">{{ $footer_social['text'] }}</p>
								<div class="col d-flex align-items-center footer-social-links">
									@if ($company_social_media['facebook'])
										<a class="pr-3 text-light" href="{!! $company_social_media['facebook'] !!}" target="_blank">
											@svg('images/icons/facebook.svg')
										</a>
									@endif
									@if ($company_social_media['instagram'])
										<a class="pl-3 text-light" href="{!! $company_social_media['instagram'] !!}" target="_blank">
											@svg('images/icons/instagram.svg')
										</a>
									@endif
								</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row align-items-center py-4">
      <div class="col">
        <p class="footer-copyright m-0">
          Copyright &copy; {{ date('Y') }} {{ $company_name['legal'] }}. All Rights Reserved.
        </p>
      </div>
    </div>
  </div>
</footer>

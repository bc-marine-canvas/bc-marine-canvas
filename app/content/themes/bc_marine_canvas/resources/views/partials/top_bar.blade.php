<nav class="navbar navbar-expand-lg bg-light nav-top-bar p-0">
  <div class="container">
    <ul class="navbar-nav ml-auto top-bar-menu">
      @if ($company_social_media['facebook'])
        <li class="nav-item py-0 social-icon">
          <a class="nav-link btn-gray border-right rounded-0 mx-0 px-3 py-0" href="{!! $company_social_media['facebook'] !!}" target="_blank">
            @svg('images/icons/facebook.svg')
          </a>
        </li>
      @endif
      @if ($company_social_media['instagram'])
        <li class="nav-item py-0 social-icon">
          <a class="nav-link btn-gray border-right rounded-0 mx-0 px-3 py-0" href="{!! $company_social_media['instagram'] !!}" target="_blank">
            @svg('images/icons/instagram.svg')
          </a>
        </li>
      @endif
      @if ($company_social_media['twitter'])
        <li class="nav-item py-0 social-icon">
          <a class="nav-link btn-gray border-right rounded-0 mx-0 px-3 py-0" href="{!! $company_social_media['twitter'] !!}" target="_blank">
            @svg('images/icons/twitter.svg')
          </a>
        </li>
      @endif
      @if ($company_social_media['linkedin'])
        <li class="nav-item py-0 social-icon">
          <a class="nav-link btn-gray border-right rounded-0 mx-0 px-3 py-0" href="{!! $company_social_media['linkedin'] !!}" target="_blank">
            @svg('images/icons/linkedin.svg')
          </a>
        </li>
      @endif
      @if ($company_social_media['youtube'])
        <li class="nav-item py-0 social-icon">
          <a class="nav-link btn-gray border-right rounded-0 mx-0 px-3 py-0" href="{!! $company_social_media['youtube'] !!}" target="_blank">
            @svg('images/icons/youtube.svg')
          </a>
        </li>
      @endif
      @if (has_nav_menu('top_bar_nav'))
        <li>{{ App::top_bar_nav() }}</li>
      @endif
      @if ($top_bar_cta['show'])
        <li class="nav-item py-0">
          <a class="btn btn-primary rounded-0 mr-0 px-3 top-bar-cta" href="{!! $top_bar_cta['link'] !!}" target="_blank">
            {{ $top_bar_cta['button_text'] }}
          </a>
        </li>
      @endif
    </ul>
  </div>
</nav>


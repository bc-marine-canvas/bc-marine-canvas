<div class="row no-gutters">
  <div class="col-md-6 order-4 order-md-3">
    <div class="masks-checklist-img" @background("{$masks_page->checklist()['image']['url']}")>&nbsp;</div>
  </div>
  <div class="col-md-6 order-3 order-md-4">
    <div class="masks-checklist-bg w-100">
      <div class="masks-checklist-opacity d-flex justify-content-start">
        <div class="p-5 masks-checklist text-white d-flex flex-column justify-content-center">
          <h2 class="mb-3">{{ $masks_page->checklist()['heading'] }}</h2>
          <ul class="masks-checklist-bullets mb-0">
            @foreach($masks_page->checklist()['bullets'] as $bullet)
              <li>{{ $bullet['text'] }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

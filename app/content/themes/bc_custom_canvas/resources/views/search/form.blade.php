<div class="row">
  <div class="col pb-4">
    <form method="get" action="/">
      <div class="form-row align-items-end">
        <div class="col">
          <label for="search-results-search">Search</label>
          <input id="search-results-search" class="form-control" type="text" name="s" value="{{ $search_terms }}" placeholder="Search">
        </div>
        <div class="col-auto">
          <button class="px-3 btn btn-primary" type="submit">
            @svg('images/icons/magnifying-glass.svg')
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

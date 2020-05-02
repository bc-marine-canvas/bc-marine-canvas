<form method="get" class="filters" id="filter">
  <div class="form-row align-items-end">
    <div class="form-group col-md">
      <label for="filter-canvas">Filter By Canvas Service</label>
      <select class="form-control custom-select" id="filter-canvas" name="canvas-id">
        <option value="" @if (!App::selected_filter('canvas-id')) selected @endif>All Canvas Services</option>
        @foreach (App::filter_for('canvas') as $filter)
          @if (in_array($filter['id'], App::filter_values()))
            <option value="{{ $filter['id'] }}" selected>{{ $filter['name'] }}</option>
          @else
            <option value="{{ $filter['id'] }}">{{ $filter['name'] }}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group col-md">
      <label for="filter-upholstery">Filter By Upholstery Service</label>
      <select class="form-control custom-select" id="filter-upholstery" name="upholstery-id">
        <option value="" @if (!App::selected_filter('upholstery-id')) selected @endif>All Upholstery Services</option>
        @foreach (App::filter_for('upholstery') as $filter)
          @if (in_array($filter['id'], App::filter_values()))
            <option value="{{ $filter['id'] }}" selected>{{ $filter['name'] }}</option>
          @else
            <option value="{{ $filter['id'] }}">{{ $filter['name'] }}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="ml-auto form-group col-md-auto">
      <button type="submit" class="btn btn-secondary d-flex align-items-center justify-content-center w-100" id="filter-submit">
        Apply
      </button>
    </div>
    <div class="ml-auto form-group col-md-auto">
      <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center w-100" id="filter-clear">
        Clear
      </button>
    </div>
  </div>
</form>

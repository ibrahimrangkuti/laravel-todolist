<div class="container">
    <div class="row justify-content-center d-flex align-items-center" style="height: 100vh;">
        <div class="col-md-6">
            <div class="card mb-4">
                <span class="text-center mt-3">Follow <a href="https://instagram.com/ranqkuty">@ranqkuty</a> dong!</span>
                <div class="card-body">
                    <div class="mb-3">
                        <input wire:model="body" type="text" class="form-control @error('body') is-invalid @enderror" placeholder="Apa yang ingin anda lakukan?">
                        @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" wire:click="submit">Tambah</button>
                </div>
            </div>
            @if ($countActivities > 0)
                <button class="btn btn-danger btn-sm mb-3" wire:click="deleteAll">Hapus Semua</button>
            @endif
            <ul wire:sortable="updateTaskOrder" class="list-group">
                @foreach ($activities as $activity)
                    <li wire:sortable.item="{{ $activity->id }}" wire:key="activity-{{ $activity->id }}" class="list-group-item d-flex justify-content-between">
                        <span wire:sortable.handle role="button">{{ $activity->body }}</span>
                        <div>
                            <button class="btn badge bg-danger" wire:click="delete({{ $activity->id }})">Hapus</button>
                            @if (!$activity->is_done)
                                <button class="btn badge bg-success" wire:click="done({{ $activity->id }})">Selesai</button>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@extends('dashboard.layouts.main')

@section('container')

    @if (session()->has('success'))
        <div class="alert alert-success mt-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('voteError'))
        <div class="alert alert-danger" role="alert">
            {{ session('voteError') }}
        </div>
    @endif
    <div class="row mt-4 d-flex justify-content-center">
        @can('yetToVote')
        <div class="col-md-4 m-4 rounded p-1 bg-light">
            <input name="voter_choose" id="voter_choose" hidden type="text" value="Christina">
            <button data-bs-toggle="modal" data-bs-target="#modalSatu" class="opac p-0 border-0" type="button">
                <div class="card border-0" >
                    <img src="/img/foto_christina.png" class="card-img-top" alt="..." style="height: 300px; object-fit:contain">
                    <div class="card-body">
                        <h5 class="card-title">Christina Septiani</h5>
                        <p class="card-text">Biologi 2021</p>
                    </div>
                </div>
            </button>
        </div>


        <div class="col-md-4 m-4 rounded p-1 bg-light">
            <button data-bs-toggle="modal" data-bs-target="#modalDua" class="opac p-0 border-0" type="submit">
                <div class="card border-0" >
                    <img src="/img/kotak_kosong.png" class="card-img-top" alt="..." style="height: 300px; object-fit:contain">
                    <div class="card-body">
                        <h5 class="card-title">Kotak Kosong</h5>
                        <p class="card-text">Memilih kotak kosong</p>
                    </div>
                </div>
            </button>
        </div>
        @endcan

        @can('alreadyVote')
            <h2 class='text-center text-light'>Terima kasih sudah memilih, nantikan hasilnya ya!</h2>
            <img src="/img/thanks.png"   alt="..." style="height: 500px;  object-fit:contain">
        @endcan
    </div>

    <!-- Modal Christina -->
    <div class="modal fade" id="modalSatu" tabindex="-1" aria-labelledby="modalSatuLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalSatuLabel">Konfirmasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apa anda yakin untuk memilih Christina Septiani?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
            <form action="/voting" method="POST">
                @csrf
                <input name="voter_choose" id="voter_choose" hidden type="text" value="Christina">
                <button class="btn btn-primary" type="submit">
                    Ya
                </button>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Kotak -->
    <div class="modal fade" id="modalDua" tabindex="-1" aria-labelledby="modalDuaLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalDuaLabel">Konfirmasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apa anda yakin untuk memilih kotak kosong?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
            <form action="/voting" method="POST">
                @csrf
                <input name="voter_choose" id="voter_choose" hidden type="text" value="Kotak">
                <button class="btn btn-primary" type="submit">
                    Ya
                </button>
            </form>
            </div>
        </div>
        </div>
    </div>
    

@endsection
<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
    myInput.focus()
    })
</script>
@extends('dashboard.layouts.main')

@section('container')
    <div class="fw-bold mt-4 navbar d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <div class="header-title">
            <h4 class="text-light" style="font-weight: normal;">{{  $title  }}</h4>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="container rvc-stat shadow">
                <div class="rvc-title title-box">
                    <div class="title-cont">
                        <h5 class="links text-center">Hasil Voting</h5>
                    </div>
                </div>
                <div class="rvc-graph bg-light">
                    <canvas id="hasil_voting"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center ">
        <div class="col-lg-8">
            <div class="container rvc-stat shadow">
                <div class="rvc-title title-box">
                    <div class="title-cont">
                        <h5 class="links">Statistik Voter</h5>
                    </div>
                </div>
                <div class="rvc-graph bg-light">
                    <canvas id="statistik_voting"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="container con-tbl px-2">
        <div class="table-responsive">
            <table class="table table-hover" >
                <thead>
                  <tr class="text-white text-left rounded" style="background-color: black">
                    <th scope="col" style="border-radius: 10px 0 0 0">ID Voter</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Pilihan</th>
                    <th scope="col" style="border-radius: 0 10px 0 0">Waktu</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($votes->count() == 0)
                        <tr class="text-center text-danger bg-light">
                            <th colspan="5">There isn't any data yet</th>
                        </tr>
                      @endif
                  @foreach ($votes as $vote)
                  <tr class="text-left bg-light">
                    <th scope="row">{{ $vote->id }}</th>
                    <td>{{ $vote->voter_name }}</td>
                    <td>{{ $vote->voter_nim }}</td>
                    <td>{{ $vote->voter_choose }}</td>
                    <td>{{ $vote->created_at->tz('Asia/Jakarta')->format('d/m/Y h:i A')}}</td>
                  </tr>  
                  @endforeach
                  
                </tbody>
            </table>
        </div>
        
    </div>

 @endsection    
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script type="module">
    const hasil_voting = document.getElementById('hasil_voting');
    const hasil_votingconfig = {
        type: 'bar',
        data: {
            labels: ['Christina Septiani', 'Kotak Kosong'],
            datasets: [{
            label: 'Jumlah Pemilih',
            data: [@json($christina_voter), @json($kotak_voter)],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        }
    };
    
    new Chart(hasil_voting, hasil_votingconfig);

    const statistik_voting = document.getElementById('statistik_voting');
    const statistik_votingconfig = {
        type: 'bar',
        data: {
            labels: ['Sudah memilih', 'Belum memilih'],
            datasets: [{
            label: 'Jumlah Peserta',
            data: [@json($voter_count), @json($yet_to_vote_count)],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        }
    };
    
    new Chart(statistik_voting, statistik_votingconfig);


 </script>



    @extends('template.app')
    @section('title', 'Table | Travel Records')
    @section('main')
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Catatan Perjalanan</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('dashboard') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('catper.index') }}">Catatan Perjalanan</a>
                    </li>
                </ul>
            </div>
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Tabel</h4>
                    </div>
                </div>
                <div class="card-body kekanan">
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ route('catper.create') }}" class="btn btn-md btn-success">Tambah Data</a>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Export Data</button>
                            <div class="dropdown-menu" x-placement="bottom-start"
                                style="position: absolute; transform: translate3d(114px, 46px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item" href="/catper/export">Excel</a>
                                <a class="dropdown-item" href="/catper/pdf" target="_blank">PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead style="background: #7a74fc" class="text-white text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Suhu Tubuh</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($catpers as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->lokasi }}</td>
                                        <td>{{ $item->suhu }} &#8451;</td>
                                        <td class="text-center">
                                            <a href="{{ route('catper.edit', $item->id) }}" class="btn btn-primary"><i
                                                    class="fas fa-edit"></i></a>
                                            <a data-toggle="modal" class="btn btn-danger text-white" id="smallButton"
                                                data-target="#smallModal" data-attr="{{ route('delete', $item->id) }}"
                                                title="Delete Project">
                                                <i class="fas fa-trash "></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- small modal -->
        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="smallBody">
                        <div>
                            <!-- the result to be displayed apply here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // display a modal (small modal)
            $(document).on('click', '#smallButton', function(event) {
                $('body').css('overflow', 'hidden')
                event.preventDefault();
                let href = $(this).attr('data-attr');
                $.ajax({
                    url: href,
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    // return the result
                    success: function(result) {
                        $('#smallModal').modal("show");
                        $('#smallBody').html(result).show();
                    },
                    complete: function() {
                        $('#loader').hide();
                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#loader').hide();
                    },
                    timeout: 8000
                })
            });

            $(document).ready(function() {
                $('.close').click(function() {
                    $('.modal-backdrop').css('display', 'none');
                    $('body').css('overflow', 'visible')
                });
            });
        </script>
        @if (session()->has('success') || session()->has('error'))
            @include('sweetalert::alert')
        @endif

    @endsection

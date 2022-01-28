@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row m-2">
            <div class="col-md-3 offset-md-9">
                <div class="form-group">
                    <select name="order_field" id="order_field" class="form-control">
                        <option value="" disabled selected>Urutkan</option>
                        <option value="best_seller">Best Seller</option>
                        <option value="terbaik">Terbaik (Berdasarkan Rating)</option>
                        <option value="termurah">Termurah</option>
                        <option value="termahal">Termahal</option>
                        <option value="terbaru">Terbaru</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col" id="gallery-list">
            <div class="row row-cols-1 row-cols-md-3">
                @foreach ($galleries as $gallery)
                    <div class="col mb-4">
                        <div class="card h-100 border-success" style="box-shadow: 10px 10px 10px grey;">
                            <img src="{{ asset("/storage/".$gallery->art_url) }}" class="card-img-top" style="height: 250px; object-fit: cover; object-position: center;">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <a href="{{ route('galleries.show', $gallery->id) }}">{{ $gallery->title }}</a>
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{!! Str::limit($gallery->desc, 120, '....') !!} </p>
                                <center>
                                    <div class="btn btn-light">
                                        <a href="{{ route('galleries.show', $gallery->id) }}">Read More</a>
                                    </div>
                                </center>
                            </div>

                            <div class="card-footer border-success" style="background-color: #72A603;">
                                <div class="btn btn-success" style="box-shadow: 3px 3px 3px black;">Rp. {{ $gallery->price }}</div>
                                <div class="text-right">
                                    <small class="text-muted">
                                        <a href="{{ route('galleries.show', $gallery->id) }}" class="btn mr-1" style="box-shadow: 3px 3px 3px black; background-color: #84BF04;"><i class="fa fa-dollar"></i></a>
                                        <a href="{{ route('carts.add', $gallery->id) }}" class="btn" style="box-shadow: 3px 3px 3px black; background-color: #8C4660;"><i class="fa fa-shopping-cart"></i></a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#order_field').change(function() {
                window.location.href = 'galleries/?order_by=' + $(this).val();
            });
        });
    </script>
@endsection
@extends('layout.layouts')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="row">
            <div class="col-md-4">
                <div class="card card-custom card-stretch gutter-b m-5">
                    <!--begin::Header-->

                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column m-5">
                        <div class="flex-grow-1">
                            <img src="{{ asset('images/shoe.png') }}" class="img-fluid" alt="san siro" />
                        </div>
                        <div class="pt-5">
                            <p class="text-center font-weight-bolder font-size-lg pb-7">
                                ADIDAS ULTRABOOST 22
                                <br /><b class="text-center font-weight-bolder font-size-h4"> PRICE: $200</b>
                            </p>
                            <a href="{{ route('payment.form') }}"
                                class="btn btn-success btn-shadow-hover font-weight-bolder w-100 py-3">Shop Now</a>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
        <!--end::Subheader-->

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->
                <!--begin::Row-->

                <!--end::Row-->
                <!--end::Dashboard-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection

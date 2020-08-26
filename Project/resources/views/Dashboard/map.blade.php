@extends('Dashboard.layouts.base')
@section('title','dashboard_map')
@section('page_id','map')

@section('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin="">
</script>
    @endsection

@section('content')
    <h3 style="color: white"> Track Orders </h3>
    <hr>

    <div id="mapid">

    </div>


    <table class="table unstriped  ">
        <thead>
        <tr>
            <td style="background-color: #800026"></td>
            <td> >600</td>
        </tr>
        <tr>
            <td style="background-color: #BD0026"></td>
            <td> 550-600</td>
        </tr>
        <tr>
            <td style="background-color: #E31A1C"></td>
            <td> 450-500</td>
        </tr>
        <tr>
            <td style="background-color: #FC4E2A"></td>
            <td> 350-400</td>
        </tr>
        <tr>
            <td style="background-color: #FD8D3C"></td>
            <td> 200-350</td>
        </tr>
        <tr>
            <td style="background-color: #FEB24C"></td>
            <td> 150-200</td>
        </tr>
        <tr>
            <td style="background-color: #FED976"></td>
            <td>0-150</td>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

@endsection

@section('script')


<script src="{{ asset('js/map.js') }}"></script>

@endsection

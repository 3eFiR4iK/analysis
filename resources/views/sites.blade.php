@extends('layouts.app')

@section('content')

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead style="font-weight: bold;">
                            <tr>
                                <td>Название сайта</td>
                                <td>категория</td>
                            </tr>
                        <thead>
                        <tbody>
                            @foreach($sites as $site)                         
                            <tr>
                                <td>{{$site->nameSite}}</td>
                                <td>&nbsp;</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

@endsection
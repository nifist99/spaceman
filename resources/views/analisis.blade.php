<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')

@php
    $result=array_chunk($row,10);
    $underOneTwo = 0;
    $underTwo = 0;

    $deteksiOne= 0;
    $upTwo = 0;
    $upFive=0;
    $upTen = 0;
    $upHundred = 0;
@endphp

<div class="row">
    <div class="col-sm-12">

        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Result Spaceman</h3>
            </div>
            
            <div class="box-body">
            <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 40px">Result</th>
                    <th style="width: 40px">Analisis</th>
                    <th style="width: 40px">Peluang</th>
                    <th style="width: 40px">Waktu</th>
                </tr>
                @foreach ($result as $key)
                <tr>
                    <td>
                        @foreach ($key as $val)
                        

                            @if($val['result']<1.2)
                                <span class="badge bg-red">{{$val['result']}}</span>
                                @php 
                                    $underOneTwo++
                                @endphp

                                @if($val['result']==1)
                                    @php $deteksiOne++ @endphp
                                @endif
                            @elseif($val['result']>=1.2 && $val['result']<2)
                            <span class="badge" style="background-color: rgb(157, 157, 157)">{{$val['result']}}</span>
                                    @php 
                                        $underTwo++
                                    @endphp

                            @elseif($val['result']>=5 && $val['result']<10)
                                <span class="badge bg-blue">{{$val['result']}}</span>
                                    @php 
                                        $upFive++
                                    @endphp
                            @elseif($val['result']>=10 && $val['result']<100)
                                <span class="badge bg-green">{{$val['result']}}</span>
                                @php 
                                    $upTen++
                                @endphp
                            @elseif($val['result']>=100)
                                @php 
                                    $upHundred++
                                @endphp
                                <span class="badge bg-yellow">{{$val['result']}}</span>
                            @else
                                <span class="badge" style="background-color: blueviolet">{{$val['result']}}</span>
                                @php 
                                    $upTwo++
                                @endphp
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <p>{{count($key)}}</p>
                        <p><span class="badge bg-red">{{$underOneTwo}}</span></p>
                        <p><span class="badge" style="background-color: rgb(157, 157, 157)">{{$underTwo }}</span></p>
                        <p><span class="badge" style="background-color: blueviolet">{{$upTwo}}</span></p>
                        <p><span class="badge bg-blue">{{$upFive}}</span></p>
                        <p><span class="badge bg-green">{{$upTen}}</span></p>
                        <p><span class="badge bg-yellow">{{$upHundred}}</span></p>
                    </td>
                    <td>
                        <p><p><span class="badge bg-red">{{Helper::peluang(3,$underOneTwo)}} x</span></p>
                        <p><p><span class="badge" style="background-color: rgb(157, 157, 157)">{{Helper::peluang(3,$underTwo)}} x</span></p>
                        <p><p><span class="badge" style="background-color: blueviolet">{{Helper::peluang(3,$upTwo)}} x</span></p>
                        <p><p><span class="badge bg-blue">{{Helper::peluang(1,$upFive+$upTen+$upHundred)}} x</span></p>
                        @if($underOneTwo>=4)
                            <h1>Reset Pola</h1>
                        @endif
                        @if(($underTwo+$underOneTwo)>=5)
                            <h1>Moment Next Round</h1>
                        @endif
                        
                    </td>
                    <td>
                        @php
                            $date=date_create($val['created_at']);
                        @endphp
                        <p>{{date_format($date,'H:i:s')}}</p>
                    </td>
                </tr>
                @php
                    $upTwo = 0;
                    $underOneTwo=0;
                    $underTwo=0;
                    $deteksiOne=0;
                    $upFive=0;
                    $upTen = 0;
                    $upHundred = 0;
                @endphp
                @endforeach
                
            </tbody>
            </table>
        </div>
        </div>

    </div>
</div>


@endsection
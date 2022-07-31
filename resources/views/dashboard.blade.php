<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')

@php
    $result1=array_chunk($row,10);
    $result2=array_reverse($result1,true);

    $result=array_slice($result2,0,5);
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
                            <p>Reset Pola</p>
                        @endif
                        @if(($underTwo+$underOneTwo)>=5)
                            <p><strong> Moment Next Round</strong></p>
                        @endif
                        <p>Peluang Muncul Angka < 1.2 = <strong> {{Helper::peluang(3,$underOneTwo)*10}} % </strong></p>
                        <p>Peluang Muncul Angka > 1.2 = <strong> {{Helper::peluang(3,$underTwo)*10}} % </strong> </p>
                        <p>Peluang Muncul Angka >  2 = <strong> {{Helper::peluang(3,$upTwo)*10}} % </strong> </p>
                        <p>Peluang Muncul Angka >  5 = <strong> {{Helper::peluang(1,$upFive+$upTen+$upHundred)*10}} % </strong> </p>

                        <h3>Kesimpulan</h3>
                        @if($underOneTwo>3)
                            <p>Ada admin, tunggu sejenak dan perhatikan pola</p>
                        @elseif(Helper::peluang(3,$underOneTwo)==3)
                            <p>Tunggu Angka dibawah 1.2 keluar / Perhatikan Pola Sebelumnya rangkaian angka kecil < 2 sebanyak 3 - 4 x</p>
                        @elseif(Helper::peluang(3,$underOneTwo)==2)
                            <p>Berani Bed di anga 1.2 kemungkinan 50 % dapat</p>
                        @else
                            <p>Berani Bed di anga 1.2 kemungkinan 70 % dapat</p>
                        @endif

                        @if($upTwo==0 && $underOneTwo>=1 && $underTwo >=1)
                            <p>peluang muncul x2 80%</p>
                        @elseif($upTwo==1 && $underOneTwo>=1 && $underTwo >=1)
                            <p>peluang muncul x2 50%</p>
                        @elseif($upTwo==2 && $underOneTwo>=1 && $underTwo >=1)
                            <p>peluang muncul x2 30%</p>
                        @else
                            <p>peluang muncul x2 10%</p>
                        @endif

                        @if(($upFive+$upTen+$upHundred)==0 && $upTwo==0 && $underOneTwo>=1 && $underTwo >=1 )
                            <p>peluang muncul angka di atas 5 x 80%</p>
                        @elseif(($upFive+$upTen+$upHundred)==0 && $upTwo==1 && $underOneTwo>=1 && $underTwo >=1 )
                            <p>peluang muncul angka di atas 5 x 50%</p>
                        @elseif(($upFive+$upTen+$upHundred)==0 && $upTwo==2 && $underOneTwo>=1 && $underTwo >=1 )
                            <p>peluang muncul angka di atas 5 x 20%</p>
                        @elseif(($upFive+$upTen+$upHundred)==0 && $upTwo==3 && $underOneTwo>=1 && $underTwo >=1 )
                            <p>peluang muncul angka di atas 5 x 10%</p>
                        @elseif(($upFive+$upTen+$upHundred)>=1)
                            <p>peluang muncul angka di atas 5 x 5%</p>
                        @endif
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

<script>
    window.setInterval('refresh()', 10000); 	// Call a function every 10000 milliseconds (OR 10 seconds).

    // Refresh or reload page.
    function refresh() {
        window .location.reload();
    }
</script>


@endsection
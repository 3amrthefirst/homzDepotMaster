
{!! \App\MyHelper\Field::text('name' , 'اسم المورد ' ) !!}
{!! \App\MyHelper\Field::text('code' , 'كود المورد ' ) !!}
{!! \App\MyHelper\Field::text('email' , 'البريد الالكتروني للمورد ' ) !!}
{!! \App\MyHelper\Field::text('phone' , 'الهاتف المحمول للمورد ' ) !!}
{!! \App\MyHelper\Field::number('adminProfit' , '  نسبة الموقع ' ) !!}




@if ($edit == true)

{!! \App\MyHelper\Field::password('oldpassword' , 'كلمه المرور القديمه' ) !!}
{!! \App\MyHelper\Field::password('password' , 'كلمه المرور الجديده' ) !!}
{!! \App\MyHelper\Field::password('password confirmation' , ' تاكيد كلمه المرور الجديده ' ) !!}


@else
{!! \App\MyHelper\Field::password('password' , 'كلمه مرور المورد' ) !!}
{!! \App\MyHelper\Field::password('password confirmation' , ' تاكيد كلمه مرور المورد ' ) !!}

@endif

    <div class="clearfix"></div>
    <br>















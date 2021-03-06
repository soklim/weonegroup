
@extends('frontend.fragement.layout')

@section('content1')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css" rel="stylesheet">


    <div style="height: 20px;"></div>
<div class="container">
    <form role="form" action="{{url('order')}}" method="post">
    <div class="row">
        <div class="col-md-12">
            <h3>Your Order</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Products</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Amount</th>

                </tr>
                </thead>
                <tbody>
                <?php $i=1;?>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <th scope="row"><?php echo $i++;?></th>
                        <td>{{ $cartItem->name }}</td>
                        <td align="center">{{$cartItem->qty }}</td>
                        <td align="left">${{ $cartItem->price }}</td>
                        <td align="left">${{ $cartItem->subtotal }}</td>
                    <!-- {{ Cart::total() }} -->
                    <!--       <td><a href="{{url('remove-cart/'.$cartItem->rowId)}}"><i class="fa fa-trash btn btn-danger"></i></td> -->
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4"><strong>Subtotal</strong></td>
                    <td align="right">{{ Cart::subtotal() }} $</td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Totals </strong></td>
                    <td align="right" style="color: red;">{{ Cart::subtotal() }} $</td>
                </tr>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Billing Detail</h3>
            <div class="form-group">
                <input type="text" name="user_id" maxlength="30" class="form-control" value="{{Auth::user()->id}}" style="display: none">
            </div>
            <div class="form-group">
                <label>City/Province: </label>
                <select class="form-control" name="province" required>
                    @foreach($province as $pro)
                    <option value="{{$pro->id}}">{{$pro->province_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Detail Address: </label>
                <textarea class="form-control" rows="5" name="address" maxlength="255">{{Auth::user()->address}}</textarea>
            </div>
            <div class="form-group">
                <label>Phone number: </label>

                <select id="countries_phone1" class="form-control bfh-countries" data-country="KH" style="display: none"></select>

                <input type="text" class="form-control bfh-phone" id="phone" name="phone" value="{{Auth::user()->phone}}" data-country="countries_phone1">
                {{--<input type="number" placeholder="Enter your phone" onKeyPress="if(this.value.length==10) return false;" class="form-control" name="phone" required>--}}
            </div>
            <div class="form-group">
                <input type="email" value="{{Auth::user()->email}}"  name="email" class="form-control" style="display: none">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3> Payment Method</h3>
            <div class="form-group">
                <label class="control-label">Payment Type</label>
                <select maxlength="200" type="select" required="required" id="payment" class="form-control" name="payment_method" style="height: 30px !important;">
                    <option value="">[--Please select--]</option>
                    <option value="aba">1. Pay By ABA Bank (000115025)</option>
                    <option value="delivery">2. Pay By Delivery</option>
                </select>
                <br>
                <label id="lblbank" style="display: none">Make your payment directly into our bank account. Please use your Order ID and phone number as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</label>
                <input type="hidden" name="total" value="{{ Cart::subtotal() }}">


            </div>
            <div class="form-group" >
                <label class="control-label">Description</label>
                <textarea maxlength="300" id="desc" maxlength="255"  class="form-control" rows="5" name="desc" ></textarea>

            </div>

            <input type="hidden" name="quantity" value="{{$cartItem->qty}}">
            <input type="hidden" name="status_product" value="1">
            <input type="hidden" name="order_unit_price" value="{{ $cartItem->price}}">
            {{ csrf_field() }}
            <div class="form-group">
                <button class="btn btn-success btn-lg pull-right" id="submit" type="submit"  >Place order</button>


                </br> </br>
            </div>

        </div>

    </div>
    </form>
</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js">
    </script>
<script>
    $(document).ready(function () {
        $('#payment').on('change', function () {
            var id = this.value;
            if (id=='aba') {
                $("#lblbank").css('display', 'block');
            }
            else {
                $("#lblbank").css('display', 'none');
            }
        })
    });

</script>

@stop






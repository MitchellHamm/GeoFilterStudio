@foreach($existingOrders as $existingOrder)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    Order #{{ $existingOrder['id'] }}
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                    Assigned To Designer: <a>{{ $existingOrder['id'] }}</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    Status: {{ $existingOrder['status'] }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    Event Type: {{ $existingOrder['event_type'] }}
                </div>
                <div class="col-sm-12 col-md-6">
                    Event Theme: {{ $existingOrder['event_theme'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    Event Type: {{ $existingOrder['event_type'] }}
                </div>
                <div class="col-sm-12 col-md-6">
                    Filter Text: {{ $existingOrder['filter_text'] }}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    Filter Colors: {{ $existingOrder['filter_colors'] }}
                </div>

            @if(!is_null($existingOrder['filter_imagery']))
                    <div class="col-sm-12 col-md-6">
                        Filter Imagery: {{ $existingOrder['filter_imagery'] }}
                    </div>
            @endif
            </div>
            <br>

            <div class="row">
                <div class="col-xs-12">
                    <a>Update Order</a>
                </div>
                <div class="col-xs-12">
                    <a>Contact Designer</a>
                </div>
                <div class="col-xs-12">
                    <a>Cancel Order</a>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    Updated at {{ date('g:i a F d, Y', strtotime($existingOrder['updated_at'])) }}
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                    Placed at {{ date('g:i a F d, Y', strtotime($existingOrder['created_at'])) }}
                </div>
            </div>
        </div>
    </div>
@endforeach
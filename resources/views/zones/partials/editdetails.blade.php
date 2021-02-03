
<div class="row">
    <div class="col-md-6">
        <input type="hidden" name="zoneid" value="{{ $zone->id ? $zone->id : '' }}">
        <div class="form-group">
            <label for="first_name">Ware House</label>
            <input type="text" class="form-control" id="warehouse"
                   name="warehouse" placeholder="Ware House" value="{{ $zone->warehouse ? $zone->warehouse : '' }}">
        </div>
         <div class="form-group">
            <label for="first_name">Room</label>
            <input type="text" class="form-control" id="room"
                   name="room" placeholder="Room" value="{{  $zone->room ? $zone->room : '' }}">
        </div>
        <div class="form-group">
            <label for="first_name">Shelf</label>
            <input type="text" class="form-control" id="shelf"
                   name="shelf" placeholder="Shelf" value="{{  $zone->room ? $zone->shelf : '' }}">
        </div>
        
   
</div>
        
    <div class="col-md-6">
        
     
    </div>

    @if ($edit)
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                <i class="fa fa-refresh"></i>
                @lang('app.update_details')
            </button>
        </div>
    @endif
</div>

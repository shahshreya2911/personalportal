<tr>
  
    <td style="width: 40px;">
       {{ $stockinattribute->productid }}
    </td>
     <td style="width: 40px;">
       {{ auth()->user()->present()->nameOrEmail }}
    </td>
     <td style="width: 40px;">
      @if(isset($remainquantity))
       {{ $remainquantity }}
       @else
        {{ $stockinattribute->quantity }}
        @endif
    </td>
   
    
   
    
</tr>
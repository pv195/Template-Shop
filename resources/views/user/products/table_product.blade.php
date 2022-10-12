@foreach ($products as $product)
     <tr>
         <td>{{ $product->name }}</td>
         <td>{{ $product->price }}</td>
         <td>{{ $product->category->name }}</td>
         <td>{{ $product->brand->name }}</td>
         <td>{{ $product->description }}</td>
         <td>{{ $product->quantity }}</td>
         <td style="display:flex">
             <a href="{{ route('user.products.edit', ['id' => $product->id]) }}"><button
                     class="btn btn-success">Edit</button></a>
             <form action="{{ route('user.products.destroy', ['id' => $product->id]) }}" method="post">
                 {{ csrf_field() }}
                 @method('delete')
                 <button type="submit" class="btn btn-success">Delete</button>
             </form>
         </td>
     </tr>
 @endforeach

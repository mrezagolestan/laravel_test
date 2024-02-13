<h2>Products</h2>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Price</th>
    </tr>
    </thead>

    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="2"> __('No Products found')</td>
        </tr>
    @endforelse
    </tbody>
</table>

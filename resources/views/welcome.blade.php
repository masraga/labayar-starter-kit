<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Labayar | starter kit</title>
</head>

<body class="bg-slate-100 w-[90%] m-auto mt-4">
  <div class="flex justify-between gap-2">
    <div class="items">
      <div class="grid grid-cols-3 gap-2">
        @foreach($products as $product)
        <div class="p-3 bg-white rounded shadow">
          <div class="w-[250px] min-h-[200px]">
            <img
              class="rounded"
              src="{{$product['image']}}"
              alt="{{$product['name']}}">
          </div>
          <div class="text-gray-700 font-bold text-lg text-center">{{$product['name']}}</div>
          <div class="text-green-600 text-lg text-center">{{$product['price']}}</div>
          <form action="#" class="form-select-product">
            <input
              type="number"
              class="w-full border border-gray-300 p-[5px] rounded text-center"
              name="productQty"
              min="1"
              value="1">
            <input type="hidden" name="productId" value="{{$product['productId']}}">
            <input type="hidden" name="productName" value="{{$product['name']}}">
            <input type="hidden" name="productPrice" value="{{$product['price']}}">
            <button type="submit" class="bg-sky-500 text-white p-[5px] font-medium mt-1 cursor-pointer rounded w-full text-center">Buy</button>
          </form>
        </div>
        @endforeach
      </div>
    </div>
    <div class="form-purchase">
      <div class="p-2 rounded w-[350px]">
        <form action="{{$redirectUrl}}" method="post" id="submit-purchase">
          @csrf
          <div class="bg-white p-2 mb-2">
            <div class="mb-1 text-gray-700 font-bold">Customer info</div>
            <div class="mb-3">
              <label for="" class="block text-gray-700 font-medium">Customer name</label>
              <input
                type="text"
                name="customerName"
                class="border border-gray-300 w-full p-[5px] rounded" value="Raga mulia kusuma">
            </div>
            <div class="mb-3">
              <label for="" class="block text-gray-700 font-medium">Customer phone</label>
              <input
                type="text"
                name="customerPhone"
                class="border border-gray-300 w-full p-[5px] rounded" value="081234567890">
            </div>
            <div class="mb-3">
              <label for="" class="block text-gray-700 font-medium">Customer name</label>
              <input
                type="text"
                name="customerEmail"
                class="border border-gray-300 w-full p-[5px] rounded" value="real.ragamulia@gmail.com">
            </div>
          </div>
          <div class="bg-white p-2">
            <div class="mb-1 text-gray-700 font-bold">Purchase items</div>
            <div class="mb-3 purchase-items">

            </div>
          </div>
          @if(!$pgMode)
          <div class="bg-white p-2 mt-2">
            <div class="mb-1 text-gray-700 font-bold">Pay amount</div>
            <div class="mb-3">
              <input
                type="number"
                class="w-full border border-gray-300 p-[5px] rounded text-center"
                name="payAmount"
                min="1">
            </div>
          </div>
          @endif
          <div class="mt-2">
            <button id="purchaseButton" type="submit" class="cursor-pointer bg-sky-500 hidden text-white font-medium w-full p-2 rounded">Purchase</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
<script>
  document.querySelectorAll(`.form-select-product`).forEach(formSelect => {
    formSelect.addEventListener("submit", formSelectEvent => {
      formSelectEvent.preventDefault()
      const qty = Number(formSelectEvent.target.elements[0].value);
      const productId = formSelectEvent.target.elements[1].value;
      const productName = formSelectEvent.target.elements[2].value;
      const productPrice = Number(formSelectEvent.target.elements[3].value);
      document.querySelector(`.purchase-items`).insertAdjacentHTML(
        'beforeend',
        `
          <div class="text-gray-700 block">${productName} x${qty}</div>
          <input type="hidden" name="productId[]" value="${productId}">
          <input type="hidden" name="productName[]" value="${productName}">
          <input type="hidden" name="productQty[]" value="${qty}">
          <input type="hidden" name="productPrice[]" value="${productPrice}">
        `
      )
      document.querySelector("#purchaseButton").classList.remove("hidden")
    })
  })
</script>
/* remove item from basket */
var removeCartItem = document.getElementsByClassName('btn btn-primary btn-sm remove')
console.log(removeCartItem);
for (var i = 0; i < removeCartItem.length; i++) {
    var button = removeCartItem[i]
    button.addEventListener('click', function () {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    })
}

function updateCartTotal() {
    var cardItemContainer = document.getElementsByClassName()
}


document.getElementById('search-bar').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let items = document.getElementsByClassName("post-container");

    for (let i = 0; i < items.length; i++) {
        let itemName = items[i].getElementsByTagName('h2')[0].textContent.toLowerCase();
      if (itemName.indexOf(filter) > -1) {
        items[i].style.display = '';
      } else {
        items[i].style.display = 'none';
      }
    }
  });
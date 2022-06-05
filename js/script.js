// Добавляем маску
$(document).ready(function(){ 
	$('.mask').mask('+7 (000) 000-00-00') 
})

// Логика формы брони книги
const bookItems = document.querySelectorAll('.item__text-btn')
const bookBookingDialog = document.querySelector('#booking-dialog')
const dialogBookInfo = bookBookingDialog.querySelector('.book-info')
const dialogBookTitle = dialogBookInfo.querySelector('.title span')
const dialogBookCategory = dialogBookInfo.querySelector('.category span')
const heroBookingDialogBtn = document.querySelector('.hero__body a')

// Скрываем информацию о книге, если диалоговое окно было откррыто не из каталога
if (heroBookingDialogBtn !== null) {
	heroBookingDialogBtn.addEventListener('click', () => {
		dialogBookInfo.style.display = 'none'
	})
}


// Логика клика по книге
bookItems.forEach(item => {
	item.addEventListener('click', (el) => {
		const itemBook = el.target.parentNode.parentNode.parentNode
		const bookTitle = itemBook.querySelector('.item__text-header').innerText
		const bookCategory = itemBook.querySelector('.item__footer p').innerText

		dialogBookInfo.style.display = 'block'
		dialogBookTitle.innerText = bookTitle
		dialogBookCategory.innerText = bookCategory
	})
})

// Отправляем данные с модального окна на сервер для почты

const modalForm = document.querySelector('#booking-dialog .modal-form');
const modalBtn = modalForm.querySelector('.btn-dialog');
const modalPhone = modalForm.querySelector('.mask');
const modalBookTitle = modalForm.querySelector('.book-info .title span')
const modalBookCategory = modalForm.querySelector('.book-info .category span')

let form = {
    phone: '',
	titleBook: '',
	categoryBook: ''
};

modalBtn.addEventListener('click', btn => {
	btn.preventDefault()
	if (
		modalBookTitle.innerText.length !== 0 && 
		modalBookCategory.innerText.length !== 0 && 
		modalPhone.value.length !== 0
	   )
	{
		form.phone = modalPhone.value
		form.titleBook = modalBookTitle.innerText
		form.categoryBook = modalBookCategory.innerText
	}

	if(modalPhone.value.length !== 0) {
		form.phone = modalPhone.value
	}

	// Делаем запрос на сервер и отправляем данные
	(async () => {
		await fetch('/mail.php', {
			method: 'POST',
			headers: {
			  "Content-Type": "application/json;charset=utf-8"
			},
			body: JSON.stringify(form)
		});      
	})();   

})
 
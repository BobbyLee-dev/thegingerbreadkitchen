class Footer {
  constructor() {
		this.catCupSvg = document.querySelector('.site-footer .cat-cup svg')
		this.cat = document.querySelector('.site-footer .cat-cup svg .cat')
    this.events()
 }

  events() {
		if (this.catCupSvg && this.cat) { 
			this.catCupSvg.addEventListener("click", (e) => this.toggleCat(e))
		}
  }

  toggleCat(e) {
		e.preventDefault();
		if (this.catCupSvg.classList.contains('show-cat')) {
			this.catCupSvg.classList.remove('show-cat')
		} else {
			this.catCupSvg.classList.add('show-cat')
		}
  }

}

export default Footer 

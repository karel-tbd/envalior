import {Controller} from '@hotwired/stimulus';
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    connect() {
        const openContent = this.element;
        const table = this.element.querySelector('.userContent')

        openContent.addEventListener('click', () => {
            console.log('clicked');
            table.classList.toggle('hidden')
        });


    }
}

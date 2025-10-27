/**
 * Toast
 * @requires https://getbootstrap.com
 */

import { Toast } from 'bootstrap'

export default (() => {
  const toastElList = [].slice.call(document.querySelectorAll('.toast'))
  const toastList = toastElList.map((toastEl) => new Toast(toastEl))
})()
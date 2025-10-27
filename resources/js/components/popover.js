/**
 * Popover
 * @requires https://getbootstrap.com
 * @requires https://popper.js.org/
 */

import { Popover } from 'bootstrap'

export default (() => {
  const popoverTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="popover"]')
  )

  const popoverList = popoverTriggerList.map(
    (popoverTriggerEl) => new Popover(popoverTriggerEl)
  )
})()
import { Component } from '@angular/core';

import { CartePage } from '../carte/carte';
import { ContactPage } from '../contact/contact';

@Component({
  templateUrl: 'tabs.html'
})
export class TabsPage {

  tab1Root = CartePage;
  tab2Root = ContactPage;

  constructor() {

  }
}

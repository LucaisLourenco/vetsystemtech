import {Component} from '@angular/core';
import {AuthUserService} from "../../services/user/auth/auth-user.service";
import {Router} from "@angular/router";
import {Urls} from "../../../enum/enumVariaveisSistema";

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.scss']
})
export class SidebarComponent {

  constructor(
    private serviceUser: AuthUserService,
    private router: Router) {
  }

  logoff() {
    this.serviceUser.logout().subscribe(()=>
      this.router.navigate([Urls.LOGIN]));
  }

  navigateHome() {
    this.router.navigate([Urls.PAGINA_PADRAO]).then(r => true);
  }
}

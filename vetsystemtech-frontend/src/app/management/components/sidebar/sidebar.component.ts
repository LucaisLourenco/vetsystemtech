import {Component} from '@angular/core';
import {AuthUserService} from "../../services/user/auth/auth-user.service";
import {Router} from "@angular/router";
import {AppRoutes} from "../../shared/app-routes";

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
    this.serviceUser.logout().subscribe(() =>
      this.router.navigate([AppRoutes.LOGIN]));
  }

  navigateHome() {
    this.router.navigate([AppRoutes.PAGINA_PADRAO]).then(r => true);
  }

  protected readonly AppRoutes = AppRoutes;
}

import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthUserService } from 'src/app/services/user/auth/auth-user.service';

@Injectable({
  providedIn: 'root'
})
export class DisconnectedUserGuard implements CanActivate {

  constructor(private service: AuthUserService,
    private router: Router
  ) { }

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    if (this.service.isAuthenticated()) {
      // se o usuário estiver logado, redireciona para a página home
      this.router.navigate(['/home']);
      return false;
    }

    return true;
  }

}

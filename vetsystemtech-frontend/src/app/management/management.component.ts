import { AuthUserService } from 'src/app/management/services/user/auth/auth-user.service';
import { Component } from '@angular/core';

@Component({
  selector: 'app-management',
  templateUrl: './management.component.html',
  styleUrls: ['./management.component.scss']
})
export class ManagementComponent {

  constructor(private service: AuthUserService) { }

  showSidebar() {
    return this.service.isAuthenticated();
  }

}

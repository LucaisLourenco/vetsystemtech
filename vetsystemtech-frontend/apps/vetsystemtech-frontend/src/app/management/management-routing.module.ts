import { UserResetPasswordComponent } from './components/user/user-reset-password/user-reset-password.component';
import { UserGuard } from './guards/disconnected/user.guard';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ManagementComponent } from './management.component';
import { HomeComponent } from './components/home/home.component';
import { UserLoginComponent } from './components/user/user-login/user-login.component';
import { DisconnectedUserGuard } from './guards/logged/disconnected-user.guard';

const routes: Routes = [
  {
    path: '',
    component: ManagementComponent,
    children: [
      { path: '', pathMatch: 'full', redirectTo: 'home' },
      { path: 'home', component: HomeComponent, canActivate: [UserGuard] },
      {
        path: 'login',
        component: UserLoginComponent,
        canActivate: [DisconnectedUserGuard],
      },
      {
        path: 'reset-password',
        component: UserResetPasswordComponent,
        canActivate: [DisconnectedUserGuard],
      },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ManagementRoutingModule {}

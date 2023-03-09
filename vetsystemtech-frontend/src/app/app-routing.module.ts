import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { HomeComponent } from './components/home/home.component';
import { UserLoginComponent } from './components/user/user-login/user-login.component';
import { UserGuard } from './guards/user/disconnected/user.guard';
import { DisconnectedUserGuard } from './guards/user/logged/disconnected-user.guard';


const routes: Routes = [
  { path: '', pathMatch: 'full', redirectTo: 'home' },
  { path: 'home', component: HomeComponent, canActivate: [UserGuard] },
  { path: 'login', component: UserLoginComponent, canActivate: [DisconnectedUserGuard] }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

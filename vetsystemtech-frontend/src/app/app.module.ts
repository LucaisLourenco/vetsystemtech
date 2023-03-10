import { HttpClientModule } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AppMaterialModule } from 'src/app/shared/app-material/app-material.module';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HomeComponent } from './components/home/home.component';
import { UserLoginComponent } from './components/user/user-login/user-login.component';
import { SidebarUserComponent } from './shared/components/sidebar-user/sidebar-user.component';
import { SidebarVeterinarianComponent } from './shared/components/sidebar-veterinarian/sidebar-veterinarian.component';
import { SidebarTutorComponent } from './shared/components/sidebar-tutor/sidebar-tutor.component';

@NgModule({
  declarations: [
    AppComponent,
    UserLoginComponent,
    HomeComponent,
    SidebarUserComponent,
    SidebarVeterinarianComponent,
    SidebarTutorComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    AppMaterialModule,
    HttpClientModule,
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

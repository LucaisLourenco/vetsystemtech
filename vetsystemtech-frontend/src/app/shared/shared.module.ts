import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AppMaterialModule } from './app-material/app-material.module';
import { ErrorDialogComponent } from './components/error-dialog/error-dialog.component';
import { ConfirmationDialogComponent } from './components/confirmation-dialog/confirmation-dialog.component';



@NgModule({
  declarations: [
    ErrorDialogComponent,
    ConfirmationDialogComponent
  ],
  imports: [
    CommonModule,
    AppMaterialModule
  ]
})
export class SharedModule { }

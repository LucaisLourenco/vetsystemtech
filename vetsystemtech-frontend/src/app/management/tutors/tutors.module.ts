import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {TutorsComponent} from './tutors.component';
import {TutorsRoutingModule} from "./tutors-routing.module";
import {AppMaterialModule} from "../../shared/app-material/app-material.module";
import {SharedModule} from "../../shared/shared.module";
import {ReactiveFormsModule} from "@angular/forms";
import {TutorListComponent} from './components/tutor-list/tutor-list.component';


@NgModule({
  declarations: [
    TutorsComponent,
    TutorListComponent
  ],
  imports: [
    CommonModule,
    TutorsRoutingModule,
    AppMaterialModule,
    SharedModule,
    ReactiveFormsModule
  ]
})
export class TutorsModule {
}

import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {TutorsComponent} from './tutors.component';
import {TutorsRoutingModule} from "./tutors-routing.module";
import {AppMaterialModule} from "../../shared/app-material/app-material.module";
import {SharedModule} from "../../shared/shared.module";
import {ReactiveFormsModule} from "@angular/forms";
import {TutorListComponent} from './components/tutor-list/tutor-list.component';
import { TutorFormComponent } from './containers/tutor-form/tutor-form.component';
import {NgxPaginationModule} from "ngx-pagination";


@NgModule({
  declarations: [
    TutorsComponent,
    TutorListComponent,
    TutorFormComponent
  ],
  imports: [
    CommonModule,
    TutorsRoutingModule,
    AppMaterialModule,
    SharedModule,
    ReactiveFormsModule,
    NgxPaginationModule
  ]
})
export class TutorsModule {
}

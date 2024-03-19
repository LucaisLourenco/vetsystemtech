import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {TutorsComponent} from "./tutors.component";
import {TutorsResolverGuard} from "./guards/tutors.resolver.guard";
import {TutorFormComponent} from "./containers/tutor-form/tutor-form.component";

const routes: Routes = [
  {path: '', component: TutorsComponent},
  {path: 'create', component: TutorFormComponent, resolve: {tutor: TutorsResolverGuard}},
  {path: 'edit/:id', component: TutorFormComponent, resolve: {tutor: TutorsResolverGuard}}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TutorsRoutingModule {
}

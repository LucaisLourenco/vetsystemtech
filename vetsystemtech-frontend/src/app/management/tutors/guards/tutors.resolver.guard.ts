import {Injectable} from '@angular/core';
import {ActivatedRouteSnapshot, Resolve, RouterStateSnapshot} from '@angular/router';
import {Observable, of} from 'rxjs';
import {TutorsService} from "../services/tutors.service";
import {Tutor} from "../model/tutor.model";

@Injectable({
  providedIn: 'root'
})
export class TutorsResolverGuard implements Resolve<Tutor> {
  constructor(private tutorsService: TutorsService) {
  }

  resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<Tutor> {
    if (route.params && route.params['id']) {
      return this.tutorsService.loadById(route.params['id']);
    }

    return of({
      id: 0,
      name: '',
      username: '',
      email: '',
      cpf: '',
      gender_id: '',
      birth: '',
      password: '',
      active: '',
      createdAt: new Date().toISOString(),
      updatedAt: new Date().toISOString(),
    });
  }
}

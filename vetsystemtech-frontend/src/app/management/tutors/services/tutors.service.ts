import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {first} from 'rxjs';
import {Tutor} from "../model/tutor.model";
import {tap} from "rxjs/operators";
import {PaginationBaseService} from "../../../core/base/pagination-base/pagination-base.service";

@Injectable({
  providedIn: 'root'
})
export class TutorsService extends PaginationBaseService<any> {

  private readonly ROUTE_TUTORS = '/tutors';
  private readonly ROUTE_TUTOR_DELETE = '/tutors/destroy?id=';
  private readonly ROUTE_TUTOR_SHOW = '/tutors/';

  protected endpoint = `${this.API}${this.ROUTE_TUTORS}`;

  constructor(override http: HttpClient) {
    super(http);
  }

  save(tutor: Partial<Tutor>) {
    if (tutor.id) {
      return this.update(tutor);
    }

    return this.store(tutor);
  }

  loadById(id: string) {
    const url = `${this.API}${this.ROUTE_TUTOR_SHOW}${id}`;
    return this.http.get<Tutor>(url).pipe(
      tap(tutor => console.log(url))
    );
  }

  private store(tutor: Partial<Tutor>) {
    return this.http.post<Tutor>(this.API, tutor).pipe(first());
  }

  update(tutor: Partial<Tutor>) {
    return this.updateBaseById(tutor as Tutor, this.ROUTE_TUTORS);
  }

  delete(id: number) {
    return this.deleteBaseById(id, this.ROUTE_TUTOR_DELETE);
  }
}

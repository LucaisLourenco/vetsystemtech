import {Injectable} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {first, Observable} from "rxjs";
import {environment} from "../../../../environments/environment.development";
import {BaseEntity} from "../../../management/tutors/model/base-entity.model";

@Injectable({
  providedIn: 'root'
})
export abstract class PaginationBaseService<T> {

  protected abstract endpoint: string;

  protected constructor(protected http: HttpClient) {
  }

  public readonly API = environment.apiUrl;

  getItems(page = 1, pageSize = 15): Observable<any> {
    return this.http.get(`${this.endpoint}?page=${page}&per_page=${pageSize}`);
  }

  deleteBaseById(id: number, route: string) {
    return this.http.delete(`${this.API}${route}${id}`).pipe(first());
  }

  updateBaseById(record: BaseEntity, route: string) {
    return this.http.put<BaseEntity>(`${this.API}${route}/${record.id}`, record).pipe(first())
  }
}

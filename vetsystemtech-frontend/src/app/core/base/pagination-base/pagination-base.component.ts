import {Injectable, OnInit, ViewChild} from '@angular/core';
import {PaginationBaseService} from "./pagination-base.service";
import {Observable, of} from "rxjs";
import {MatPaginator} from "@angular/material/paginator";

@Injectable({
  providedIn: 'root'
})
export abstract class PaginationBaseComponent<T> implements OnInit {

  @ViewChild(MatPaginator) paginator!: MatPaginator;

  items$: Observable<T[]> | null = null;
  currentPage = 1;
  totalPage = 1;
  length = 1;
  pageSize: number = 15;

  protected constructor(private paginationService: PaginationBaseService<T>) {
  }

  ngOnInit(): void {
    this.loadItems(this.currentPage, this.pageSize);
  }

  loadItems(page = 1, pageSize = 15): void {
    this.paginationService.getItems(page, pageSize).subscribe(response => {
      this.items$ = of(response.data);
      this.currentPage = response.current_page;
      this.totalPage = response.last_page;
      this.length = response.total;
    });
  }

  goToPage(page: number, pageSize: number) {
    this.pageSize = pageSize;
    this.loadItems(page, pageSize);
    return this.currentPage;
  }
}

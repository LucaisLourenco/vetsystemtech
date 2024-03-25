import {Injectable} from '@angular/core';
import {SelectionModel} from "@angular/cdk/collections";

@Injectable({
    providedIn: 'root'
})
export abstract class ListBaseComponent<T> {

    selection = new SelectionModel<any>(true, []);

    abstract get data(): T[];

    getSelectedItems(): T[] {
        return this.selection.selected;
    }

    masterToggle() {
        this.isAllSelected() ?
            this.selection.clear() :
            this.data.forEach((row: T) => this.selection.select(row));
    }

    isAllSelected() {
        const numSelected = this.selection.selected.length;
        const numRows = this.data.length;
        return numSelected === numRows;
    }
}

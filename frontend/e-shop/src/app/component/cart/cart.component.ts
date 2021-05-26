import { Component, OnInit } from '@angular/core';
import { ProductModel } from 'src/app/models/product.model';
import { CartService } from 'src/app/services/cart.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  listProduct: {
    product: ProductModel,
    quantity: number
  }[] = [];

  totalPrice;
  buySuccess = false;

  constructor(public cartService: CartService) { }

  ngOnInit(): void {
    this.listProduct = this.cartService.listProduct;
  }

  deleteCart(){
    this.cartService.deleteAll();
    this.listProduct = this.cartService.listProduct;
  }

  addProduct(p){
    this.cartService.addProduct(p, 1);
  }

  minusProduct(p){
    this.cartService.removeProduct(p, 1);
  }

  buy(){
    this.cartService.deleteAll();
    this.listProduct = this.cartService.listProduct;
    this.buySuccess = true;
  }
}
